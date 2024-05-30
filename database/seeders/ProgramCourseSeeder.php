<?php

namespace Database\Seeders;

use App\Models\Program;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProgramCourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $programs = $this->getPrograms();
        foreach ($programs as $program) {
            $created_program = Program::query()->updateOrCreate(['name' => $program['name']],[
                'name' => $program['name'],
                'image' => $program['image'],
            ]);
            // Add courses for the program
            foreach ($program['courses'] as $course) {
                $created_program->courses()->updateOrCreate(['name' => $course['name']], [
                    "name" => $course['name'],
                    "university" => @$course['university'],
                    "image" => @$course['image'],
                    "pdf_file" => @$course['pdf_file']
                ]);
            }
        }
    }

    protected function getPrograms(): array
    {
        return [
            // program 1
            [
                'name' => 'UK - Undergraduate Programmes',
                'image' => 'programs/courses-1.jpg',
                'courses' => [
                    // course 2
                    [
                        'name' => 'BA (Hons) in Business Management',
                        'university' => 'Wrexham Glyndwr university',
                        'image' => 'courses/bba.jpg',
                        'pdf_file' => 'pdf/BA (Hons) Accounting and Finance-TopUp.pdf',
                    ],
                    // course 2
                    [
                        'name' => 'BA (Hons) Accounting & Finance',
                        'university' => 'University of Derby',
                        'image' => 'courses/hq720.jpg',
                        'pdf_file' => 'pdf/BA (Hons) Accounting and Finance-TopUp.pdf',
                    ],
                    // course 3
                    [
                        'name' => 'BSc (Hons) In computing',
                        'university' => 'Wrexham Glyndwr university',
                        'image' => 'courses/computing.png',
                        'pdf_file' => 'pdf/BSc (Hons) in Computing-Top Up.pdf',
                    ],
                    // course 4
                    [
                        'name' => 'BEng in Software Engineering',
                        'university' => 'University of Bolton',
                        'image' => 'courses/se.png',
                        'pdf_file' => 'pdf/BEng Software Engineering-TopUp.pdf',
                    ],
                ],
            ],
            // program 2
            [
                'name' => 'UK - Postgraduate Programmes',
                'image' => 'programs/courses-2.jpg',
                'courses' => [
                    // course 2
                    [
                        'name' => 'Master of Business Administration (MBA)',
                        'university' => 'University of Gloucestershire',
                        'image' => 'courses/Getty_519548244.jpg',
                        'pdf_file' => 'pdf/MBA - TopUp.pdf',
                    ],
                    // course 3
                    [
                        'name' => 'MSc Human Resource Management',
                        'university' => 'University of Gloucestershire',
                        'image' => 'courses/111.jpeg',
                        'pdf_file' => 'pdf/MSc Human Resource Management-Top up.pdf',
                    ],
                    // course 4
                    [
                        'name' => 'MSc Project Management',
                        'university' => 'Buckinghamshire New University',
                        'image' => 'courses/wwww.png',
                        'pdf_file' => 'pdf/MSc in Project Management-Full.pdf',
                    ],
                    // course 5
                    [
                        'name' => 'MSc Accounting & Finance',
                        'university' => 'University of Gloucestershire',
                        'image' => 'courses/fff.png',
                        'pdf_file' => 'pdf/MSc Accounting and Finance -TopUp.pdf',
                    ],
                    // course 6
                    [
                        'name' => 'MSc Healthcare Management',
                        'university' => 'Anglia Ruskin University',
                        'image' => 'courses/hhh.png',
                        'pdf_file' => 'pdf/MSc Healthcare Management- TopUp.pdf',
                    ],
                    // course 7
                    [
                        'name' => 'Masters of Law - LLM',
                        'university' => 'University of Central Lancashire',
                        'image' => 'courses/lll.png',
                        'pdf_file' => 'pdf/Master of Laws (LLM)-TopUp.pdf',
                    ],
                ],
            ],
            // program 3
            [
                'name' => 'Executive Education',
                'image' => 'programs/courses-3.jpg',
                'courses' => [
                    [
                        'name' => 'Mini MBA',
                    ],
                    [
                        'name' => 'Collaboration , Partnership and Negotiation',
                    ],
                    [
                        'name' => 'Startups and Entrepreneurship',
                    ],
                    [
                        'name' => 'Risk Management',
                    ],
                    [
                        'name' => 'Financial Management',
                    ],
                    [
                        'name' => 'Customer Service Excellence',
                    ],
                ],
            ],
            // program 4
            [
                'name' => 'US-UK Other Programmes Through Partners',
                'image' => 'programs/courses-4.jpg',
                'courses' => [],
            ],
        ];
    }
}
