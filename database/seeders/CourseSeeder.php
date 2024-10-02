<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Course;

class CourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $courses = [
            'BA Advertising',
            'BA Communication',
            'BA English',
            'BA International Studies',
            'BA Psychology',
            'BA Sociology',
            'BA Political Science',
            'BS Accountancy',
            'BS Agriculture',
            'BS Architecture',
            'BS Aviation',
            'BS Biology',
            'BS Chemical Engineering',
            'BS Chemistry',
            'BS Civil Engineering',
            'BS Computer Engineering',
            'BS Computer Science',
            'BS Criminology',
            'BSBA Marketing Management',
            'BSBA Human Resource Management',
            'BSBA Financial Management',
            'BSBA Banking & Microfinance',
            'BS Electrical Engineering',
            'BS Electronics and Communications Engineering',
            'BS Environmental Science',
            'BS Hospitality Management',
            'BS Industrial Engineering',
            'BS Information Technology',
            'BS Marine Engineering',
            'BS Maritime Transportation',
            'BS Nursing',
            'BS Nutrition and Dietetics',
            'BS Pharmacy',
            'BS Physical Therapy',
            'BS Psychology',
            'BS Real Estate Management',
            'BS Tourism Management',
            'BSEd Science',
            'BSEd Mathematics',
            'BSEd English',
            'BSEd Filipino',
            'Bachelor of Special Needs Education',
            'Bachelor of Elementary Education',
            'Associate in Hospitality Management',
            'Culinary Arts',
            'Data Science',
            'Digital Marketing',
            'DBA (Doctor of Business Administration)',
            'LLB (Doctor of Jurisprudence - Law)',
            'MD (Doctor of Medicine)',
            'PhD in Education',
            'Fashion Design',
            'Fine Arts',
            'Graphic Design',
            'Information Systems',
            'Interior Design',
            'MA Education',
            'MBA (Master of Business Administration)',
            'MPA (Master of Public Administration)',
            'MS Nursing',
            'MS Information Technology',
            'Massage Therapy',
            'Multimedia Arts',
            'Project Management',
            'TESOL (Teaching English as a Second Language)',
            'Web Development'
        ];
        
        foreach ($courses as $course) {
            Course::create([
                'course' => $course,
            ]);
        }
    }
}
