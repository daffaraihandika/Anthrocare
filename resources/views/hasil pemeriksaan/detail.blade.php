@extends('layouts.main')

@section('container')

<h1>Hasil Pemeriksaan Detail Bayi</h1>
    <div class="col d-flex justify-content-end align-items-end" >
        <ol class="breadcrumb">
            <li class="breadcrumb-item " aria-current="page">
                <a href="/hasilPemeriksaan" class="text-decoration-none">Hasil Pemeriksaan</a>
            </li>
            <li class="breadcrumb-item " aria-current="page">
                <a class="text-decoration-none text-secondary">Detail</a>
            </li>
        </ol>
    </div>

<div class="row">
    <div class="col-md-8">
        <div class="row">
            <div class="col-md-3">Nama Bayi </div>
            <div class="col-md-5">: {{ $identitas_bayi[0]->nama_bayi }}</div>
        </div>
        <div class="row">
            <div class="col-md-3">Tanggal Lahir Bayi </div>
            <div class="col-md-5">: {{ $identitas_bayi[0]->tgl_lahir_bayi }}</div>
        </div>
        <div class="row">
            <div class="col-md-3">Jenis Kelamin Bayi </div>
            <div class="col-md-5">: {{ $identitas_bayi[0]->jenis_kelamin }}</div>
        </div>
        <div class="row">
            <div class="col-md-3">No Akte Bayi </div>
            <div class="col-md-5">: {{ $identitas_bayi[0]->no_akte_bayi}}</div>
        </div>
        <div class="row">
            <div class="col-md-3">Umur </div>
            <div class="col-md-5">: {{ $identitas_bayi[0]->usia }} Bulan</div>
        </div>
        <div class="row">
            <div class="col-md-3">Nama Orang Tua  </div>
            <div class="col-md-5">: {{ $identitas_bayi[0]->nama_orangtua }}</div>
        </div>
        <div class="row">
            <div class="col-md-3">Alamat Orang Tua  </div>
            <div class="col-md-5">: {{ $identitas_bayi[0]->alamat}}</div>
        </div>
    </div>
</div>

{{-- bikin tabel di bawah identitas bayi, 
isi atributnya ada tanggal pemeriksaan, suhu, berat, 
panjang badan, zscore, kondisi --}}
<h1>Riwayat Pemeriksaan Terbaru</h1>
<table class="table">
    <thead>
        <tr class="text-center">
            <th scope="col">Tanggal Pemeriksaan</th>
            <th scope="col">Suhu (Celcius)</th>
            <th scope="col">Berat (Kg)</th>
            <th scope="col">Panjang (Cm)</th>
            <th scope="col">Z-Score</th>
            <th scope="col">Kondisi</th>
        </tr>
    </thead>
    <tbody>
        <tr class="text-center">
            <td>{{$last_inspection->tgl_pemeriksaan}}</td>
            <td>{{$last_inspection->suhu}}°C</td>
            <td>{{$last_inspection->berat}}Kg</td>
            <td>{{$last_inspection->panjang_badan}}Cm</td>
            <td>{{$last_inspection->zscore}}</td>
            <td>{{$last_inspection->kondisi}}</td>
        </tr>
        <tr class="text-start">
            <td colspan="6">Saran Makanan :{!! $status['food_suggestions'] !!}</td>
        </tr>
    </tbody>
</table>

<h1>Riwayat Pemeriksaan</h1>
<table class="table">
    <thead>
        <tr class="text-center">
            <th scope="col">Tanggal Pemeriksaan</th>
            <th scope="col">Suhu (Celcius)</th>
            <th scope="col">Berat (Kg)</th>
            <th scope="col">Panjang (Cm)</th>
            <th scope="col">Z-Score</th>
            <th scope="col">Kondisi</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($all_inspection as $item)
        <tr class="text-center">
            <td>{{$item->tgl_pemeriksaan}}</td>
            <td>{{$item->suhu}}°C</td>
            <td>{{$item->berat}}Kg</td>
            <td>{{$item->panjang_badan}}Cm</td>
            <td>{{$item->zscore}}</td>
            <td>{{$item->kondisi}}</td>
        </tr>
        @endforeach
    </tbody>
</table>

<h1>Grafik Pertumbuhan</h1>
<!-- Create a div where the graph will take place -->
<div id="my_dataviz"></div>

<!-- Add a div for tooltip -->
<div id="tooltip" style="position: absolute; opacity: 0; pointer-events: none; background-color: white; padding: 8px; border-radius: 5px; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);"></div>

    
<a href="{{ url('/hasilPemeriksaan/exportPDF/'.$identitas_bayi[0]->id) }}">
    <button class="btn btn-success">Cetak PDF</button>
</a>

<script src="https://d3js.org/d3.v7.min.js"></script> <!-- Include D3.js library -->

<script>
    // Get the inspection data from PHP variable
    const inspectionData = {!! json_encode($all_inspection) !!};

    console.log(inspectionData); // Print the data to the console for debugging

    // set the dimensions and margins of the graph
    const margin = { top: 30, right: 100, bottom: 70, left: 60 }, // Adjusted margin for axis labels
        width = 600 - margin.left - margin.right,
        height = 400 - margin.top - margin.bottom;

    // append the svg object to the body of the page
    const svg = d3.select("#my_dataviz")
        .append("svg")
        .attr("width", width + margin.left + margin.right)
        .attr("height", height + margin.top + margin.bottom)
        .append("g")
        .attr("transform", `translate(${margin.left},${margin.top})`);

    // Sort inspectionData by the date if not already sorted
    inspectionData.sort((a, b) => new Date(a.tanggal_pemeriksaan) - new Date(b.tanggal_pemeriksaan));

    // Create an array of inspection numbers starting from 1
    const inspectionNumbers = Array.from({ length: inspectionData.length }, (_, index) => index + 1);

    // A color scale: one color for each inspection number
    const myColor = d3.scaleOrdinal()
        .domain(inspectionNumbers)
        .range(d3.schemeSet2);

    // Add X axis
    const x = d3.scaleLinear()
        .domain([1, inspectionNumbers.length]) // Start from 1
        .range([0, width]);
    svg.append("g")
        .attr("transform", `translate(0, ${height})`)
        .call(d3.axisBottom(x).ticks(inspectionNumbers.length).tickValues(inspectionNumbers).tickFormat(d3.format('d'))); // Specify tick values and format as integers

    // Add X axis label
    svg.append("text")
        .attr("transform", `translate(${width / 2}, ${height + margin.top + 10})`) // Centered below x-axis
        .style("text-anchor", "middle")
        .text("Pemeriksaan ke-");

    // Add Y axis
    const y = d3.scaleLinear()
        .domain([0, d3.max(inspectionData, d => d.panjang_badan)])
        .range([height, 0]);
    svg.append("g")
        .call(d3.axisLeft(y));

    // Add Y axis label
    svg.append("text")
        .attr("transform", "rotate(-90)")
        .attr("y", -margin.left)
        .attr("x", -height / 2)
        .attr("dy", "1em")
        .style("text-anchor", "middle")
        .text("Panjang Badan");

    // Add the lines
    const line = d3.line()
        .x((_, index) => x(inspectionNumbers[index]))
        .y(d => y(d.panjang_badan));
    svg.append("path")
        .datum(inspectionData)
        .attr("d", line)
        .attr("stroke", "#8DA0CB")
        .style("stroke-width", 4)
        .style("fill", "none");

    // Add the points
    svg.selectAll("myDots")
    .data(inspectionData)
    .join("circle")
    .attr("cx", (_, index) => x(inspectionNumbers[index]))
    .attr("cy", d => y(d.panjang_badan))
    .attr("r", 5)
    .attr("fill", "#8DA0CB")
    .on("mouseover", (event, d) => {
        // Show tooltip on mouseover
        console.log(d)
        d3.select("#tooltip")
            .style("opacity", 1)
            .html(`Tanggal Pemeriksaan: ${d.tgl_pemeriksaan}<br>Panjang Badan: ${d.panjang_badan} cm`)
            .style("left", (event.pageX + 10) + "px")
            .style("top", (event.pageY - 15) + "px");
    })
    .on("mouseout", () => {
        // Hide tooltip on mouseout
        d3.select("#tooltip").style("opacity", 0);
    });

</script>

@endsection 