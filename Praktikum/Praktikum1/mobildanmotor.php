<?php

// Namespace untuk Sistem Kendaraan
namespace SistemKendaraan;

// Trait untuk menampilkan informasi
trait InformasiKendaraan {
    public function getDetail() {
        return [
            'Merek' => $this->merek,
            'Model' => $this->model,
            'Tahun' => $this->tahun,
            'Pemilik' => $this->pemilik->getNama()
        ];
    }
}

// Abstract class untuk Kendaraan
abstract class Kendaraan {
    protected $merek;
    protected $model;
    protected $tahun;
    protected $pemilik;

    public function __construct($merek, $model, $tahun, PemilikKendaraan $pemilik) {
        $this->merek = $merek;
        $this->model = $model;
        $this->tahun = $tahun;
        $this->pemilik = $pemilik;
    }

    abstract public function deskripsi();
}

// Class Mobil yang mewarisi Kendaraan
class Mobil extends Kendaraan {
    use InformasiKendaraan;

    public function deskripsi() {
        return "Mobil {$this->merek} {$this->model} dari tahun {$this->tahun}.";
    }

    public function toJson() {
        return json_encode($this->getDetail(), JSON_PRETTY_PRINT);
    }
}

// Class Motor yang mewarisi Kendaraan
class Motor extends Kendaraan {
    use InformasiKendaraan;

    public function deskripsi() {
        return "Motor {$this->merek} {$this->model} dari tahun {$this->tahun}.";
    }

    public function toJson() {
        return json_encode($this->getDetail(), JSON_PRETTY_PRINT);
    }
}

// Abstract class untuk Pemilik
abstract class Pemilik {
    protected $nama;
    protected $alamat;

    public function __construct($nama, $alamat) {
        $this->nama = $nama;
        $this->alamat = $alamat;
    }

    abstract public function getNama();
}

// Class PemilikKendaraan yang mewarisi Pemilik
class PemilikKendaraan extends Pemilik {
    public function getNama() {
        return $this->nama;
    }

    public function getAlamat() {
        return $this->alamat;
    }

    public function toJson() {
        return json_encode([
            'Nama' => $this->nama,
            'Alamat' => $this->alamat
        ], JSON_PRETTY_PRINT);
    }
}

// Magic Method __toString untuk Pemilik
class PemilikDenganToString extends PemilikKendaraan {
    public function __toString() {
        return json_encode([
            'Nama' => $this->nama,
            'Alamat' => $this->alamat
        ], JSON_PRETTY_PRINT);
    }
}

// Penggunaan Program
$pemilik = new PemilikKendaraan("Budi", "Jl. Merdeka No. 10");
$mobil = new Mobil("Toyota", "Avanza", 2020, $pemilik);
$motor = new Motor("Honda", "CBR", 2018, $pemilik);

header('Content-Type: application/json'); // Set header untuk output JSON

// Membuat array untuk menyimpan semua output
$output = [
    'DetailMobil' => json_decode($mobil->toJson()),
    'DetailMotor' => json_decode($motor->toJson()),
    'Pemilik' => json_decode($pemilik->toJson()),
    'PemilikDenganMagicMethod' => json_decode($pemilikToString = new PemilikDenganToString("Andi", "Jl. Mawar No. 25"))
];

// Mengonversi seluruh output menjadi JSON
echo json_encode($output, JSON_PRETTY_PRINT);
