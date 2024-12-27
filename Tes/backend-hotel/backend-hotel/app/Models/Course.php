<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    protected $fillable = [
        'course_name',        // Nama kursus
        'description',        // Deskripsi kursus
        'start_date',         // Tanggal mulai
        'end_date',           // Tanggal selesai
        'instructor_name',    // Nama instruktur
    ];

    /**
     * Relasi ke model Student.
     * Satu kursus bisa memiliki banyak peserta (students).
     */
    public function students()
    {
        return $this->hasMany(Student::class);
    }
}
