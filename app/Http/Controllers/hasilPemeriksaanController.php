<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Infant;
use App\Models\Parents;
use App\Models\Pemeriksaan;
use Carbon\Carbon;
use PDF;
// use Barryvdh\DomPDF\Facade\Pdf;
//
class hasilPemeriksaanController extends Controller
{
    public function index(){
        $title = 'Hasil Pemeriksaan';
        $data_bayi = Pemeriksaan::join('infants', 'pemeriksaan.id_infant', '=', 'infants.id')
    ->join('parents', 'infants.id_parent', '=', 'parents.id')
    ->select(
        'pemeriksaan.id_infant',
        'infants.nama_bayi',
        'infants.no_akte_bayi',
        'infants.tgl_lahir_bayi',
        'infants.jenis_kelamin',
        'parents.nama_orangtua',
        'parents.no_ktp',
    )
    ->distinct("pemeriksaan.id_infant")
    ->groupBy('infants.nama_bayi')
    ->paginate(10);

        return view('hasil pemeriksaan/indexHasilPemeriksaan', compact('title', 'data_bayi'));
    }

    public function getInfant($id){
        $foodSuggestions = '';
        $title = "Hasil Pemeriksaan";
        $identitas_bayi = Infant::join('parents', 'infants.id_parent', '=', 'parents.id')
        ->where('infants.id', $id)
        ->select(
            'infants.id',
            'infants.nama_bayi', 
            'infants.jenis_kelamin', 
            'infants.tgl_lahir_bayi', 
            'infants.no_akte_bayi', 
            'parents.nama_orangtua', 
            'parents.alamat'
        )
        ->get();

        $identitas_bayi->map(function ($bayi) {
            $bayi->usia = $this->calculateAgeInMonths($bayi->tgl_lahir_bayi);
            return $bayi;
        });

        $all_inspection = Pemeriksaan::join('infants', 'pemeriksaan.id_infant', '=', 'infants.id')
        ->where('pemeriksaan.id_infant', $id)
        ->select(
            'pemeriksaan.tgl_pemeriksaan', 
            'pemeriksaan.suhu', 
            'pemeriksaan.berat', 
            'pemeriksaan.panjang_badan', 
            'pemeriksaan.zscore', 
            'pemeriksaan.kondisi'
        )
        ->get();

        $last_inspection = Pemeriksaan::join('infants', 'pemeriksaan.id_infant', '=', 'infants.id')
        ->where('pemeriksaan.id_infant', $id)
        ->select(
            'pemeriksaan.tgl_pemeriksaan', 
            'pemeriksaan.suhu', 
            'pemeriksaan.berat', 
            'pemeriksaan.panjang_badan', 
            'pemeriksaan.zscore', 
            'pemeriksaan.kondisi',
            'pemeriksaan.created_at',
            'infants.usia',
            'infants.tgl_lahir_bayi'
        )
        ->orderBy('pemeriksaan.created_at', 'desc')
        ->first();

        // food suggestion
        if($last_inspection['usia'] <= 12){
            // jika usia anak 1 tahun (usia <= 12 bulan)
            if($last_inspection['kondisi'] == 'tinggi'){
                $foodSuggestions = "
                <ul>
                    <li>Disarankan balita mendapatkan ASI atau susu formula yang cukup.</li>
                    <li>Memberikan makanan padat seperti buah dan sayuran, cereal bayi, dan daging yang telah dihaluskan.</li>
                    <li>Produk susu seperti yogurt rendah lemak bisa diberikan jika anak tidak memiliki alergi susu.</li>
                </ul>
                ";
            }else if($last_inspection['kondisi'] == 'normal'){
                $foodSuggestions = "
                <ul>
                    <li>Disarankan balita mendapatkan ASI atau susu formula yang cukup.</li>
                    <li>Memberikan makanan padat seperti buah dan sayuran, cereal bayi, dan daging yang telah dihaluskan.</li>
                    <li>Dapat memberikan telur rebus yang telah dicincang halus.</li>
                    <li>Produk susu seperti yogurt rendah lemak bisa diberikan jika anak tidak memiliki alergi susu.</li>
                    <li>Pastikan balita mendapatkan air yang cukup.</li>
                </ul>
                ";
            }else if($last_inspection['kondisi'] == 'stunted'){
                $foodSuggestions = "
                <ul>
                    <li>Disarankan balita mendapatkan ASI atau susu formula yang cukup.</li>
                    <li>Memberikan makanan padat seperti buah dan sayuran, cereal bayi, dan daging yang telah dihaluskan.</li>
                    <li>Sumber protein yang dihaluskan seperti daging tanpa lemak atau telur rebus yang dicincang halus.</li>
                </ul>
                ";
            }else if($last_inspection['kondisi'] == 'severely stunted'){
                $foodSuggestions = '
                <ul>
                    <li>Teruskan pemberian ASI atau susu formula, dan mungkin dokter akan merekomendasikan tambahan nutrisi atau suplemen yang sesuai dengan kebutuhannya</li>
                    <li>Pastikan makanan yang mereka konsumsi mengandung banyak nutrisi, termasuk protein, zat besi, kalsium, vitamin, dan mineral.</li>
                    <li>Sayuran seperti bayam dan kangkung mengandung zat besi yang baik untuk membantu meningkatkan kadar hemoglobin dalam darah.</li>
                    <li>Berikan lebih banyak sumber protein seperti telur yang dihaluskan, daging tanpa lemak, ikan, dan kacang-kacangan.</li>
                    <li>Selalu berkonsultasi dengan dokter atau ahli gizi untuk perencanaan diet yang lebih khusus sesuai kebutuhan anak. Balita dengan kondisi ini mungkin memerlukan perawatan medis yang terkoordinasi.</li>
                </ul>
                ';
            }
        }else if($last_inspection['usia'] <= 24 && $last_inspection['usia'] > 12){
            // jika usia anak 2 tahun (12 bulan < usia <= 24 bulan)
            if($last_inspection['kondisi'] == 'tinggi'){
                $foodSuggestions = '
                <ul>
                    <li>ASI atau susu rendah lemak masih diberikan, tetapi makanan padat harus menjadi komponen utama.</li>
                    <li>Perkenalkan tekstur yang lebih kasar, seperti potongan buah, sayuran, roti gandum, dan pasta.</li>
                    <li>Sumber protein seperti daging, ikan, telur, dan kacang-kacangan perlu diperkenalkan lebih banyak.</li>
                    <li>Berikan sayuran hijau dan makanan tinggi serat seperti oatmeal.</li>
                    <li>Produk susu rendah lemak dan yogurt penting untuk pertumbuhan tulang yang baik.</li>
                </ul>
                ';
            }else if($last_inspection['kondisi'] == 'normal'){
                $foodSuggestions = '
                <ul>
                    <li>Tetap berikan ASI atau susu rendah lemak untuk asupan kalsium yang baik.</li>
                    <li>Berikan berbagai jenis sayuran dan buah-buahan untuk memastikan asupan vitamin dan serat yang cukup.</li>
                    <li>Pastikan balita mendapatkan cukup protein dari sumber seperti daging tanpa lemak, ayam, ikan, telur, dan kacang-kacangan.</li>
                    <li>Sumber karbohidrat seperti nasi, roti gandum, dan sereal yang rendah gula sangat penting untuk energi.</li>
                </ul>
                ';
            }else if($last_inspection['kondisi'] == 'stunted'){
                $foodSuggestions = '
                <ul>
                    <li>Lanjutkan dengan asupan ASI atau susu rendah lemak.</li>
                    <li>Berikan makanan padat dengan tekstur yang lebih kasar seperti potongan buah, sayuran, roti gandum, dan pasta.</li>
                    <li>Tingkatkan asupan protein dari daging, ikan, telur, dan kacang-kacangan.</li>
                    <li>Pastikan balita mendapatkan cukup serat dari sayuran hijau dan oatmeal.</li>
                </ul>
                ';
            }else if($last_inspection['kondisi'] == 'severely stunted'){
                $foodSuggestions = '
                <ul>
                    <li>ASI atau susu rendah lemak harus tetap menjadi sumber nutrisi utama, dan mungkin diperlukan suplemen nutrisi tambahan yang diresepkan oleh dokter.</li>
                    <li>Pastikan makanan yang dikonsumsi mengandung banyak nutrisi, termasuk protein, zat besi, kalsium, vitamin, dan mineral.</li>
                    <li>Sayuran seperti bayam dan kangkung mengandung zat besi yang baik untuk membantu meningkatkan kadar hemoglobin dalam darah.</li>
                    <li>Selalu berkonsultasi dengan dokter atau ahli gizi untuk perencanaan diet yang lebih khusus sesuai kebutuhan anak Anda. Balita dengan kondisi ini mungkin memerlukan perawatan medis yang terkoordinasi.</li>
                </ul>
                ';
            }
        }else if($last_inspection['usia'] > 24){
            // jika usia anak lebih dari 2 tahun (usia > 24 bulan)
            if($last_inspection['kondisi'] == 'tinggi'){
                $foodSuggestions = '
                <ul>
                    <li>Berikan berbagai jenis sayuran dan buah-buahan untuk memastikan asupan vitamin dan serat yang cukup.</li>
                    <li>Pastikan balita mendapatkan cukup protein dari sumber seperti daging tanpa lemak, ayam, ikan, telur, dan kacang-kacangan.</li>
                    <li>Sumber karbohidrat seperti nasi, roti gandum, dan sereal yang rendah gula sangat penting untuk energi.</li>
                    <li>Pastikan balita mendapatkan air yang cukup.</li>
                </ul>
                ';
            }else if($last_inspection['kondisi'] == 'normal'){
                $foodSuggestions = '
                <ul>
                    <li>Berikan berbagai jenis sayuran dan buah-buahan untuk memastikan asupan vitamin dan serat yang cukup.</li>
                    <li>Pastikan balita mendapatkan cukup protein dari sumber seperti daging tanpa lemak, ayam, ikan, telur, dan kacang-kacangan.</li>
                    <li>Sumber karbohidrat seperti nasi, roti gandum, dan sereal yang rendah gula sangat penting untuk energi.</li>
                    <li>Pastikan balita mendapatkan air yang cukup.</li>
                </ul>
                ';
            }else if($last_inspection['kondisi'] == 'stunted'){
                $foodSuggestions = '
                <ul>
                    <li>Berikan sayuran hijau gelap dan buah-buahan untuk asupan vitamin dan serat yang tinggi.</li>
                    <li>Pastikan balita mendapatkan cukup protein dari sumber seperti daging tanpa lemak, ayam, ikan, telur, dan kacang-kacangan.</li>
                    <li>Makanan seperti hati, kacang-kacangan, dan biji-bijian mengandung zat besi yang baik untuk membantu meningkatkan kadar hemoglobin dalam darah.</li>
                    <li>Selalu berkonsultasi dengan dokter anak atau ahli gizi untuk perencanaan diet yang lebih khusus sesuai kebutuhan anak.</li>
                </ul>
                ';
            }else if($last_inspection['kondisi'] == 'severely stunted'){
                $foodSuggestions = '
                <ul>
                    <li>Pastikan balita mendapatkan cukup protein dari sumber seperti daging tanpa lemak, ayam, ikan, telur, dan kacang-kacangan.</li>
                    <li>Makanan seperti hati, kacang-kacangan, dan biji-bijian mengandung zat besi yang baik untuk membantu meningkatkan kadar hemoglobin dalam darah.</li>
                    <li>Produk susu rendah lemak atau alternatif yang diperkaya kalsium seperti yogurt dan keju penting untuk pertumbuhan tulang yang baik.</li>
                    <li>Pastikan balita mendapatkan cukup vitamin dan serat dari sayuran hijau gelap dan buah-buahan. Ini dapat membantu meningkatkan asupan nutrisi mereka.</li>
                    <li>Dokter anak atau ahli gizi mungkin merekomendasikan minyak ikan atau suplemen omega-3 sebagai bagian dari perawatan nutrisi untuk membantu pemulihan pertumbuhan.</li>
                </ul>
                ';
            }
        }

        $status = [
            'kondisi' => $last_inspection['kondisi'],
            'food_suggestions' => $foodSuggestions
        ];


        // return $last_inspection;
        return view('hasil pemeriksaan/detail', compact('title', 'identitas_bayi', 'last_inspection', 'all_inspection', 'status'));
    }

    public function calculateAgeInMonths($birthdate) {
        $birthdate = Carbon::parse($birthdate);
        $currentDate = Carbon::now();
    
        $ageInMonths = $currentDate->diffInMonths($birthdate);
    
        return $ageInMonths;
    }

    public function exportPDF($id){
        // $pdf = Pdf::loadView('pdf.invoice');
        $identitas_bayi = Infant::join('parents', 'infants.id_parent', '=', 'parents.id')
        ->where('infants.id', $id)
        ->select(
            'infants.id',
            'infants.nama_bayi', 
            'infants.jenis_kelamin', 
            'infants.tgl_lahir_bayi', 
            'infants.no_akte_bayi', 
            'parents.nama_orangtua', 
            'parents.alamat'
        )
        ->get();

        $identitas_bayi->map(function ($bayi) {
            $bayi->usia = $this->calculateAgeInMonths($bayi->tgl_lahir_bayi);
            return $bayi;
        });        

        $all_inspection = Pemeriksaan::join('infants', 'pemeriksaan.id_infant', '=', 'infants.id')
        ->where('pemeriksaan.id_infant', $id)
        ->select(
            'pemeriksaan.tgl_pemeriksaan', 
            'pemeriksaan.suhu', 
            'pemeriksaan.berat', 
            'pemeriksaan.panjang_badan', 
            'pemeriksaan.zscore', 
            'pemeriksaan.kondisi'
        )
        ->get();

        $last_inspection = Pemeriksaan::join('infants', 'pemeriksaan.id_infant', '=', 'infants.id')
        ->where('pemeriksaan.id_infant', $id)
        ->select(
            'pemeriksaan.tgl_pemeriksaan', 
            'pemeriksaan.suhu', 
            'pemeriksaan.berat', 
            'pemeriksaan.panjang_badan', 
            'pemeriksaan.zscore', 
            'pemeriksaan.kondisi',
            'pemeriksaan.created_at'
        )
        ->orderBy('pemeriksaan.created_at', 'desc')
        ->first();

        // food suggestion
        if($last_inspection['usia'] <= 12){
            // jika usia anak 1 tahun (usia <= 12 bulan)
            if($last_inspection['kondisi'] == 'tinggi'){
                $foodSuggestions = "
                <ul>
                    <li>Disarankan balita mendapatkan ASI atau susu formula yang cukup.</li>
                    <li>Memberikan makanan padat seperti buah dan sayuran, cereal bayi, dan daging yang telah dihaluskan.</li>
                    <li>Produk susu seperti yogurt rendah lemak bisa diberikan jika anak tidak memiliki alergi susu.</li>
                </ul>
                ";
            }else if($last_inspection['kondisi'] == 'normal'){
                $foodSuggestions = "
                <ul>
                    <li>Disarankan balita mendapatkan ASI atau susu formula yang cukup.</li>
                    <li>Memberikan makanan padat seperti buah dan sayuran, cereal bayi, dan daging yang telah dihaluskan.</li>
                    <li>Dapat memberikan telur rebus yang telah dicincang halus.</li>
                    <li>Produk susu seperti yogurt rendah lemak bisa diberikan jika anak tidak memiliki alergi susu.</li>
                    <li>Pastikan balita mendapatkan air yang cukup.</li>
                </ul>
                ";
            }else if($last_inspection['kondisi'] == 'stunted'){
                $foodSuggestions = "
                <ul>
                    <li>Disarankan balita mendapatkan ASI atau susu formula yang cukup.</li>
                    <li>Memberikan makanan padat seperti buah dan sayuran, cereal bayi, dan daging yang telah dihaluskan.</li>
                    <li>Sumber protein yang dihaluskan seperti daging tanpa lemak atau telur rebus yang dicincang halus.</li>
                </ul>
                ";
            }else if($last_inspection['kondisi'] == 'severely stunted'){
                $foodSuggestions = '
                <ul>
                    <li>Teruskan pemberian ASI atau susu formula, dan mungkin dokter akan merekomendasikan tambahan nutrisi atau suplemen yang sesuai dengan kebutuhannya</li>
                    <li>Pastikan makanan yang mereka konsumsi mengandung banyak nutrisi, termasuk protein, zat besi, kalsium, vitamin, dan mineral.</li>
                    <li>Sayuran seperti bayam dan kangkung mengandung zat besi yang baik untuk membantu meningkatkan kadar hemoglobin dalam darah.</li>
                    <li>Berikan lebih banyak sumber protein seperti telur yang dihaluskan, daging tanpa lemak, ikan, dan kacang-kacangan.</li>
                    <li>Selalu berkonsultasi dengan dokter atau ahli gizi untuk perencanaan diet yang lebih khusus sesuai kebutuhan anak. Balita dengan kondisi ini mungkin memerlukan perawatan medis yang terkoordinasi.</li>
                </ul>
                ';
            }
        }else if($last_inspection['usia'] <= 24 && $last_inspection['usia'] > 12){
            // jika usia anak 2 tahun (12 bulan < usia <= 24 bulan)
            if($last_inspection['kondisi'] == 'tinggi'){
                $foodSuggestions = '
                <ul>
                    <li>ASI atau susu rendah lemak masih diberikan, tetapi makanan padat harus menjadi komponen utama.</li>
                    <li>Perkenalkan tekstur yang lebih kasar, seperti potongan buah, sayuran, roti gandum, dan pasta.</li>
                    <li>Sumber protein seperti daging, ikan, telur, dan kacang-kacangan perlu diperkenalkan lebih banyak.</li>
                    <li>Berikan sayuran hijau dan makanan tinggi serat seperti oatmeal.</li>
                    <li>Produk susu rendah lemak dan yogurt penting untuk pertumbuhan tulang yang baik.</li>
                </ul>
                ';
            }else if($last_inspection['kondisi'] == 'normal'){
                $foodSuggestions = '
                <ul>
                    <li>Tetap berikan ASI atau susu rendah lemak untuk asupan kalsium yang baik.</li>
                    <li>Berikan berbagai jenis sayuran dan buah-buahan untuk memastikan asupan vitamin dan serat yang cukup.</li>
                    <li>Pastikan balita mendapatkan cukup protein dari sumber seperti daging tanpa lemak, ayam, ikan, telur, dan kacang-kacangan.</li>
                    <li>Sumber karbohidrat seperti nasi, roti gandum, dan sereal yang rendah gula sangat penting untuk energi.</li>
                </ul>
                ';
            }else if($last_inspection['kondisi'] == 'stunted'){
                $foodSuggestions = '
                <ul>
                    <li>Lanjutkan dengan asupan ASI atau susu rendah lemak.</li>
                    <li>Berikan makanan padat dengan tekstur yang lebih kasar seperti potongan buah, sayuran, roti gandum, dan pasta.</li>
                    <li>Tingkatkan asupan protein dari daging, ikan, telur, dan kacang-kacangan.</li>
                    <li>Pastikan balita mendapatkan cukup serat dari sayuran hijau dan oatmeal.</li>
                </ul>
                ';
            }else if($last_inspection['kondisi'] == 'severely stunted'){
                $foodSuggestions = '
                <ul>
                    <li>ASI atau susu rendah lemak harus tetap menjadi sumber nutrisi utama, dan mungkin diperlukan suplemen nutrisi tambahan yang diresepkan oleh dokter.</li>
                    <li>Pastikan makanan yang dikonsumsi mengandung banyak nutrisi, termasuk protein, zat besi, kalsium, vitamin, dan mineral.</li>
                    <li>Sayuran seperti bayam dan kangkung mengandung zat besi yang baik untuk membantu meningkatkan kadar hemoglobin dalam darah.</li>
                    <li>Selalu berkonsultasi dengan dokter atau ahli gizi untuk perencanaan diet yang lebih khusus sesuai kebutuhan anak Anda. Balita dengan kondisi ini mungkin memerlukan perawatan medis yang terkoordinasi.</li>
                </ul>
                ';
            }
        }else if($last_inspection['usia'] > 24){
            // jika usia anak lebih dari 2 tahun (usia > 24 bulan)
            if($last_inspection['kondisi'] == 'tinggi'){
                $foodSuggestions = '
                <ul>
                    <li>Berikan berbagai jenis sayuran dan buah-buahan untuk memastikan asupan vitamin dan serat yang cukup.</li>
                    <li>Pastikan balita mendapatkan cukup protein dari sumber seperti daging tanpa lemak, ayam, ikan, telur, dan kacang-kacangan.</li>
                    <li>Sumber karbohidrat seperti nasi, roti gandum, dan sereal yang rendah gula sangat penting untuk energi.</li>
                    <li>Pastikan balita mendapatkan air yang cukup.</li>
                </ul>
                ';
            }else if($last_inspection['kondisi'] == 'normal'){
                $foodSuggestions = '
                <ul>
                    <li>Berikan berbagai jenis sayuran dan buah-buahan untuk memastikan asupan vitamin dan serat yang cukup.</li>
                    <li>Pastikan balita mendapatkan cukup protein dari sumber seperti daging tanpa lemak, ayam, ikan, telur, dan kacang-kacangan.</li>
                    <li>Sumber karbohidrat seperti nasi, roti gandum, dan sereal yang rendah gula sangat penting untuk energi.</li>
                    <li>Pastikan balita mendapatkan air yang cukup.</li>
                </ul>
                ';
            }else if($last_inspection['kondisi'] == 'stunted'){
                $foodSuggestions = '
                <ul>
                    <li>Berikan sayuran hijau gelap dan buah-buahan untuk asupan vitamin dan serat yang tinggi.</li>
                    <li>Pastikan balita mendapatkan cukup protein dari sumber seperti daging tanpa lemak, ayam, ikan, telur, dan kacang-kacangan.</li>
                    <li>Makanan seperti hati, kacang-kacangan, dan biji-bijian mengandung zat besi yang baik untuk membantu meningkatkan kadar hemoglobin dalam darah.</li>
                    <li>Selalu berkonsultasi dengan dokter anak atau ahli gizi untuk perencanaan diet yang lebih khusus sesuai kebutuhan anak.</li>
                </ul>
                ';
            }else if($last_inspection['kondisi'] == 'severely stunted'){
                $foodSuggestions = '
                <ul>
                    <li>Pastikan balita mendapatkan cukup protein dari sumber seperti daging tanpa lemak, ayam, ikan, telur, dan kacang-kacangan.</li>
                    <li>Makanan seperti hati, kacang-kacangan, dan biji-bijian mengandung zat besi yang baik untuk membantu meningkatkan kadar hemoglobin dalam darah.</li>
                    <li>Produk susu rendah lemak atau alternatif yang diperkaya kalsium seperti yogurt dan keju penting untuk pertumbuhan tulang yang baik.</li>
                    <li>Pastikan balita mendapatkan cukup vitamin dan serat dari sayuran hijau gelap dan buah-buahan. Ini dapat membantu meningkatkan asupan nutrisi mereka.</li>
                    <li>Dokter anak atau ahli gizi mungkin merekomendasikan minyak ikan atau suplemen omega-3 sebagai bagian dari perawatan nutrisi untuk membantu pemulihan pertumbuhan.</li>
                </ul>
                ';
            }
        }

        $status = [
            'kondisi' => $last_inspection['kondisi'],
            'food_suggestions' => $foodSuggestions
        ];

        $pdf = PDF::loadView('pdf.detail', [
            'identitas_bayi' => $identitas_bayi,
            'last_inspection' => $last_inspection,
            'all_inspection' => $all_inspection,
            'status' => $status
        ]);
        $pdf->setPaper('a5', 'portrait');
        // return $pdf->stream();
        // Mendapatkan nama bayi
        $nama_bayi = $identitas_bayi->first()->nama_bayi; // Mengambil nama bayi dari data pertama dalam koleksi

        // Custom nama file download
        $nama_file = $nama_bayi . '_hasil-pemeriksaan.pdf';

        return $pdf->download($nama_file);
        // return "tes";
    }


    // api
    public function indexapi(){
        $title = 'Hasil Pemeriksaan';
        $data_bayi = Pemeriksaan::join('infants', 'pemeriksaan.id_infant', '=', 'infants.id')
    ->join('parents', 'infants.id_parent', '=', 'parents.id')
    ->select(
        'pemeriksaan.id_infant',
        'infants.nama_bayi',
        'infants.no_akte_bayi',
        'infants.tgl_lahir_bayi',
        'infants.jenis_kelamin',
        'parents.nama_orangtua',
        'parents.no_ktp',
    )
    ->distinct("pemeriksaan.id_infant")
    ->groupBy('infants.nama_bayi')
    ->paginate(10);

       return $data_bayi;
    }

    public function getInfantapi($id){
        $foodSuggestions = '';
        $title = "Hasil Pemeriksaan";
        $identitas_bayi = Infant::join('parents', 'infants.id_parent', '=', 'parents.id')
        ->where('infants.id', $id)
        ->select(
            'infants.id',
            'infants.nama_bayi', 
            'infants.jenis_kelamin', 
            'infants.tgl_lahir_bayi', 
            'infants.no_akte_bayi', 
            'parents.nama_orangtua', 
            'parents.alamat'
        )
        ->get();

        $identitas_bayi->map(function ($bayi) {
            $bayi->usia = $this->calculateAgeInMonths($bayi->tgl_lahir_bayi);
            return $bayi;
        });

        $all_inspection = Pemeriksaan::join('infants', 'pemeriksaan.id_infant', '=', 'infants.id')
        ->where('pemeriksaan.id_infant', $id)
        ->select(
            'pemeriksaan.tgl_pemeriksaan', 
            'pemeriksaan.suhu', 
            'pemeriksaan.berat', 
            'pemeriksaan.panjang_badan', 
            'pemeriksaan.zscore', 
            'pemeriksaan.kondisi'
        )
        ->get();

        $last_inspection = Pemeriksaan::join('infants', 'pemeriksaan.id_infant', '=', 'infants.id')
        ->where('pemeriksaan.id_infant', $id)
        ->select(
            'pemeriksaan.tgl_pemeriksaan', 
            'pemeriksaan.suhu', 
            'pemeriksaan.berat', 
            'pemeriksaan.panjang_badan', 
            'pemeriksaan.zscore', 
            'pemeriksaan.kondisi',
            'pemeriksaan.created_at',
            'infants.usia',
            'infants.tgl_lahir_bayi'
        )
        ->orderBy('pemeriksaan.created_at', 'desc')
        ->first();

        $status = [
            'kondisi' => $last_inspection['kondisi'],
            'food_suggestions' => $foodSuggestions
        ];


        return $last_inspection;
        // return view('hasil pemeriksaan/detail', compact('title', 'identitas_bayi', 'last_inspection', 'all_inspection', 'status'));
    }
}