<?php 
 
// Namespace 
namespace MakananBanjar; 
 
// Trait untuk informasi tambahan 
trait InformasiMakanan { 
    public function tampilkanAsalMakanan() { 
        return "Makanan khas dari daerah Banjar, Kalimantan Selatan."; 
    } 
} 
 
// Abstract Class 
abstract class Makanan { 
    protected $nama; 
    protected $harga; 
 
    public function __construct($nama, $harga) { 
        $this->nama = $nama; 
        $this->harga = $harga; 
    } 
 
    // Abstract method untuk deskripsi 
    abstract public function deskripsi(); 
 
    // Method untuk menampilkan informasi makanan 
    public function infoMakanan() { 
        return "Nama Makanan: $this->nama, Harga: Rp. $this->harga"; 
    } 
} 
 
// Class SotoBanjar (Inheritance dari Makanan) 
class SotoBanjar extends Makanan { 
    use InformasiMakanan; // Menggunakan trait 
 
    private $bahan_utama; 
 
    public function __construct($harga, $bahan_utama) { 
        parent::__construct("Soto Banjar", $harga); 
        $this->bahan_utama = $bahan_utama; 
    } 
 
    // Implementasi metode abstrak 
    public function deskripsi() { 
        return "Soto Banjar adalah makanan khas yang terbuat dari $this->bahan_utama."; 
    } 
} 
 
// Class KueApam (Inheritance dari Makanan) 
class KueApam extends Makanan { 
    use InformasiMakanan; // Menggunakan trait 
 
    private $jenis_kue; 
 
    public function __construct($harga, $jenis_kue) { 
        parent::__construct("Kue Apam", $harga); 
        $this->jenis_kue = $jenis_kue; 
    } 
 
    // Implementasi metode abstrak 
    public function deskripsi() { 
        return "Kue Apam adalah makanan khas Banjar yang berjenis $this->jenis_kue."; 
    } 
} 
 
// Program Utama 
$sotoBanjar = new SotoBanjar(25000, "daging ayam dan rempah-rempah"); 
$kueApam = new KueApam(5000, "kue basah tradisional"); 
 
echo $sotoBanjar->infoMakanan() . PHP_EOL; 
echo $sotoBanjar->deskripsi() . PHP_EOL; 
echo $sotoBanjar->tampilkanAsalMakanan() . PHP_EOL; 
 
echo PHP_EOL; 
 
echo $kueApam->infoMakanan() . PHP_EOL; 
echo $kueApam->deskripsi() . PHP_EOL; 
echo $kueApam->tampilkanAsalMakanan() . PHP_EOL; 
 
?>