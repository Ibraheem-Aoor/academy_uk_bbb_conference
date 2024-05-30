<?php

namespace Database\Seeders;

use App\Models\CrfCourse;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CrfCourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $crf_courses = $this->getDataToSeed();
        foreach ($crf_courses as $crf_course) {
            $created_crf_course = CrfCourse::query()->updateOrCreate(['name' => $crf_course['name']], [
                'name' => $crf_course['name'],
                'parent_id' => @$crf_course['parent_id'],
            ]);
            if (isset($crf_course['levels'])) {
                foreach ($crf_course['levels'] as $level) {
                    $created_crf_course->levels()->updateOrCreate(['name' => $level['name']], [
                        'name' => $level['name'],
                        'description' => $level['description'],
                    ]);
                }
            }
        }
    }


    protected function getDataToSeed(): array
    {
        return [
            // crf 1
            [
                'name' => 'CRF In Digital Marcketing',
                'levels' => [
                    // level 1
                    [
                        'name' => 'FIRST LEVEL COURSE',
                        'description' => file_get_contents(public_path('html/dmg_1.html')),
                    ],
                    // level 2
                    [
                        'name' => 'SECOND LEVEL COURSE',
                        'description' => file_get_contents(public_path('html/dmg_2.html')),
                    ],

                ],
            ],
            // crf 2
            [
                'name' => 'CRF In Graphic Design',
                'levels' => [
                    // level 1
                    [
                        'name' => 'FIRST LEVEL COURSE',
                        'description' => file_get_contents(public_path('html/graph_1.html')),


                    ],
                    // level 2
                    [
                        'name' => 'SECOND LEVEL COURSE',
                        'description' => file_get_contents(public_path('html/graph_2.html')),

                    ],
                ]

            ],

            // crf 3
            [
                'name' => 'CRF In Voice Over',
                'levels' => [
                    //level 1
                    [
                        'name' => 'FIRST LEVEL COURSE',
                        'description' => file_get_contents(public_path('html/voice_1.html')),
                    ],
                    // level 2
                    [
                        'name' => 'SECOND LEVEL COURSE',
                        'description' => file_get_contents(public_path('html/voice_1.html')),
                    ],
                ]
            ],
            // Crf 4 : this has the crf 5 and crf 6 as childrens
            [
                'name' => 'CRF In Programming (IT)',
            ],
            // Crf 5
            [
                'name' => 'CRF in "Mobile App Development"',
                'parent_id' => 4,

                'levels' => [
                    // level 1
                    [
                        'name' => 'FIRST LEVEL COURSE',
                        'description' => file_get_contents(public_path('html/mobile_1.html')),
                    ],
                    // level 2
                    [
                        'name' => 'SECOND LEVEL COURSE',
                        'description' => file_get_contents(public_path('html/mobile_2.html')),
                    ],
                ],
            ],
            // Crf 6
            [
                'name' => 'CRF in "Web Development"',
                'parent_id' => 4,
                'levels' => [
                    // level 1
                    [
                        'name' => 'FIRST LEVEL COURSE',
                        'description' => file_get_contents(public_path('html/web_1.html')),
                    ],
                    // level 2
                    [
                        'name' => 'SECOND LEVEL COURSE',
                        'description' => file_get_contents(public_path('html/web_2.html')),
                    ],
                ],
            ],
            //crf 7
            [
                'name' => 'CRF In Engineering',
                'levels' => [
                    // level 1
                    [
                        'name' => 'FIRST LEVEL COURSE',
                        'description' => file_get_contents(public_path('html/eng_1.html')),

                    ],
                    // level 2
                    [
                        'name' => 'SECOND LEVEL COURSE',
                        'description' => file_get_contents(public_path('html/eng_2.html')),

                    ],
                ],
            ],
            // CRF 8
            [
                'name' => 'CRF In Translation',
                'levels' => [
                    // level 1
                    [
                        'name' => 'FIRST LEVEL COURSE',
                        'description' => file_get_contents(public_path('html/trans_1.html')),
                    ],
                    // level 2
                    [
                        'name' => 'SECOND LEVEL COURSE',
                        'description' => file_get_contents(public_path('html/trans_2.html')),

                    ],
                ],
            ],
            // CRF 9
            [
                'name' => 'CRF In Content Writing',
                'levels' => [
                    // level 1
                    [
                        'name' => 'FIRST LEVEL COURSE',
                        'description' => file_get_contents(public_path('html/content_1.html')),
                    ],
                    // level 2
                    [
                        'name' => 'SECOND LEVEL COURSE',
                        'description' => file_get_contents(public_path('html/content_2.html')),

                    ],
                ],
            ],
            // CRF 10
            [
                'name' => 'CRF In E-Commerce',
                'levels' => [
                    // level 1
                    [
                        'name' => 'FIRST LEVEL COURSE',
                        'description' => "
                            <div style='font-size: small;'>
                                <p style='color: black;'>
                                    LONDON COLLEGE Of Development Studies (LCDS), UK,
                                    Concerned With Providing Professional Training Courses That Develop And Refine The Trainee's
                                    Skill And Knowledge And Qualify Him To Be A Professional In His Field And Able To Compete In It.
                                </p>
                                <p style='color: black;'>
                                    <strong>OUR TRAINERS</strong>: They Are A Distinguished Group Of Professionals In Their Field, And They Are Fluent
                                    In The English Language. They Were Carefully Selected From All Over The Arab World To Share
                                    Their Professional Experiences Through Training Courses, So That The Result Is A Group Of
                                    Graduates Who Are Professionals In Their Field.
                                </p>
                                <p style='color: black;'>
                                    <strong>THE FIRST LEVEL OF THE PROGRAM (E-COMMERCE BEGINNERS' COURSE)</strong>
                                    <br>
                                    <strong>COURSE CONTENTS:</strong>
                                    <br>
                                    It Is A Course Specialized In E-Commerce, With A Duration Of 30 Training
                                    Hours, And After Passing It, You Will Obtain A Certificate (E-Commerce Beginners' Course)
                                    Endorsed By The UK Government.
                                    <br>
                                    <strong>COURSE FEES</strong>: $140
                                    <br>
                                    <strong>WITH PROFESSIONAL TRAINER</strong>: ENG. ASHRAF AL-MADHOUN
                                </p>
                            </div>
                        ",
                    ],
                    // level 2
                    [
                        'name' => 'SECOND LEVEL COURSE',
                        'description' => "
                            <div style='font-size: small;'>
                                <p style='color: black;'>
                                    <strong>E-Commerce COURSE</strong>: IS The Second Level Of The Levels Of (Certified Remote Freelancer)
                                    Course, After Passing It, You Will Get A Certificate With A Professional Title 'CRF In E-Commerce'
                                    That Qualifies You To Work As A Remote Freelancer And Trainer.
                                </p>
                                <p style='color: black;'>
                                    <strong>COURSE FEES</strong>: $140
                                    <br>
                                    <strong>TRAINING HOURS</strong>: 50 TRAINING HOUR
                                </p>
                                <p style='color: black;'>
                                    <strong>COURSE CONTENTS:</strong>
                                </p>
                                <ul>
                                    <li>The Meaning Of E-Commerce And Its History</li>
                                    <li>Types Of E-Commerce And Its Importance To The Merchant And The Consumer</li>
                                    <li>
                                        Sources Of Income In E-Commerce, Mentioning The Pros And Cons Of Each Source Of Income
                                    </li>
                                    <li>Learn About Online Store Platforms</li>
                                    <li>Explanation Of Drop Shipping, Affiliate Marketing, And Amazon FBA</li>
                                    <li>Create A Professional Store From Scratch, Buy A Domain And Link It To The Store</li>
                                    <li>How To Add Successful Tangible And Digital Products And Consultations Or On Demand,
                                    With The Most Important Advice On That</li>
                                    <li>How To Activate Commission Marketing For Your Marketers</li>
                                    <li>How To Send Reminders To Your Customers Who Left The Product In The Basket</li>
                                    <li>How To Create Special Coupons For Your Customers</li>
                                    <li>How To Communicate With Technical Support And Benefit From The Services</li>
                                    <li>Explain The Method Of Negotiation With Suppliers And Shipping Companies And
                                    Come Up With The Best Prices</li>
                                    <li>Tips On How To Avoid Problems And Not Fall Into Them</li>
                                </ul>
                            </div>
                        ",
                    ],
                ],
            ],
            // CRF 11
            [
                'name' => 'CRF In Video Montage',
                'levels' => [
                    // level 1
                    [
                        'name' => 'FIRST LEVEL COURSE',
                        'description' => "
                            <div style='font-size: small;'>
                                <p style='color: black;'>
                                    LONDON COLLEGE Of Development Studies (LCDS), UK,
                                    Concerned With Providing Professional Training Courses That Develop And Refine The Trainee's
                                    Skill And Knowledge And Qualify Him To Be A Professional In His Field And Able To Compete In It.
                                </p>
                                <p style='color: black;'>
                                    <strong>OUR TRAINERS</strong>: They Are A Distinguished Group Of Professionals In Their Field, And They Are Fluent
                                    In The English Language. They Were Carefully Selected From All Over The Arab World To Share
                                    Their Professional Experiences Through Training Courses, So That The Result Is A Group Of
                                    Graduates Who Are Professionals In Their Field.
                                </p>
                                <p style='color: black;'>
                                    <strong>THE FIRST LEVEL OF THE PROGRAM (VIDEO MONTAGE BEGINNERS' COURSE)</strong>
                                    <br>
                                    <strong>COURSE CONTENTS:</strong>
                                    <br>
                                    It Is A Course Specialized In Video Montage, With A Duration Of 30 Training
                                    Hours, And After Passing It, You Will Obtain A Certificate (Video Montage Beginners' Course)
                                    Endorsed By The UK Government.
                                    <br>
                                    <strong>COURSE FEES</strong>: $140
                                    <br>
                                    <strong>WITH PROFESSIONAL TRAINER</strong>: ENG. ASHRAF AL-MADHOUN
                                </p>
                            </div>
                        ",
                    ],
                    // level 2
                    [
                        'name' => 'SECOND LEVEL COURSE',
                        'description' => "
                            <div style='font-size: small;'>
                                <p style='color: black;'>
                                    <strong>Video Montage COURSE</strong>: IS The Second Level Of The Levels Of (Certified Remote Freelancer)
                                    Course, After Passing It, You Will Get A Certificate With A Professional Title 'CRF In Video Montage'
                                    That Qualifies You To Work As A Remote Freelancer And Trainer.
                                </p>
                                <p style='color: black;'>
                                    <strong>COURSE FEES</strong>: $140
                                    <br>
                                    <strong>TRAINING HOURS</strong>: 50 TRAINING HOUR
                                </p>
                                <p style='color: black;'>
                                    <strong>COURSE CONTENTS:</strong>
                                </p>
                                <ul>
                                    <li>Learn The Basics Of Visual Content For Social Media Platforms And Youtube</li>
                                    <li>The Ability To Select The Type And Nature Of The Video Most Appropriate For The Audience</li>
                                    <li>Knowing The Video Conditions For Each Of The Social Media Platforms And Youtube</li>
                                    <li>The Ability To Prepare An Idea For The Content According To The Study Of The Audience And The Platform</li>
                                    <li>Property Rights And Legal Dealings With Them</li>
                                    <li>Learn About The Types And Classifications Of Montage Programs</li>
                                    <li>Learn About The Interface And Workspaces Of Adobe Premiere</li>
                                    <li>Video Montage And Editing With Adobe Premiere</li>
                                    <li>Add Visual And Sound Effects Add Visual And Audio Transitions</li>
                                    <li>Writing On Videos</li>
                                    <li>Complete Video Production Suitable For Social Media Platforms.</li>
                                    <li>Preparation Of Photography Techniques</li>
                                    <li>Working In Virtual Studios (Chroma)</li>
                                    <li>Learn Infographics (Whiteboard) And Create Educational And Educational Videos With Technology</li>
                                    <li>Editing, Processing And Purifying The Sound From Impurities</li>
                                    <li>Learn About The Auxiliary Tools In The Audio Production Process</li>
                                    <li>Mobile Video Making</li>
                                    <li>Mastering Video Shooting And Editing Using Mobile Applications</li>
                                </ul>
                            </div>
                        ",
                    ],
                ],
            ],
            // Crf 12
            [
                'name' => 'CRF In Accounting And Consulting',
                'levels' => [
                    // level 1
                    [
                        'name' => 'FIRST LEVEL COURSE',
                        'description' => "
                        <div style='font-size: small;'>
                            <p style='color: black;'>
                                LONDON COLLEGE Of Development Studies (LCDS), UK,
                                Concerned With Providing Professional Training Courses That Develop And Refine The Trainee's
                                Skill And Knowledge And Qualify Him To Be A Professional In His Field And Able To Compete In It.
                            </p>
                            <p style='color: black;'>
                                <strong>OUR TRAINERS</strong>: They Are A Distinguished Group Of Professionals In Their Field, And They Are Fluent
                                In The English Language. They Were Carefully Selected From All Over The Arab World To Share
                                Their Professional Experiences Through Training Courses, So That The Result Is A Group Of
                                Graduates Who Are Professionals In Their Field.
                            </p>
                            <p style='color: black;'>
                                <strong>THE FIRST LEVEL OF THE PROGRAM (ACCOUNTING AND CONSULTING BEGINNERS' COURSE)</strong>
                                <br>
                                <strong>COURSE CONTENTS:</strong>
                                <br>
                                It Is A Course Specialized In Accounting And Consulting, With A Duration Of 30 Training
                                Hours, And After Passing It, You Will Obtain A Certificate (Accounting And Consulting Beginners' Course)
                                Endorsed By The UK Government.
                                <br>
                                <strong>COURSE FEES</strong>: $140
                                <br>
                                <strong>WITH PROFESSIONAL TRAINER</strong>: ENG. ASHRAF AL-MADHOUN
                            </p>
                        </div>
                    ",
                    ],
                    // level 2
                    [
                        'name' => 'SECOND LEVEL COURSE',
                        'description' => "
                        <div style='font-size: small;'>
                            <p style='color: black;'>
                                <strong>Accounting And Consulting COURSE</strong>: IS The Second Level Of The Levels Of (Certified Remote Freelancer)
                                Course, After Passing It, You Will Get A Certificate With A Professional Title 'CRF In Accounting And Consulting'
                                That Qualifies You To Work As A Remote Freelancer And Trainer.
                            </p>
                            <p style='color: black;'>
                                <strong>COURSE FEES</strong>: $140
                                <br>
                                <strong>TRAINING HOURS</strong>: 50 TRAINING HOUR
                            </p>
                            <p style='color: black;'>
                                <strong>COURSE CONTENTS:</strong>
                            </p>
                            <ul>
                                <li>The Most Important Accounting Terms And Definitions</li>
                                <li>Types Of Accounting And Their Relationship To The Accounting Cycle</li>
                                <li>Preparing Reports And Financial Statements In The Light Of International Standards</li>
                                <li>Introduction To International Accounting Standards (IAS) And International Auditing Standards (ISA)</li>
                                <li>How To Set International Accounting Standards</li>
                                <li>The Importance And Benefits Of Using International Accounting And Auditing Standards</li>
                                <li>A List Of International Accounting And Auditing Standards Issued So Far With Reference To The Latest Amendments</li>
                                <li>Preparing Financial Statements And Final Accounts In Light Of International Standards</li>
                                <li>Transition To The International Financial Reporting Standards (IFRS)</li>
                                <li>International Financial Reporting Standards (IFRS) And Generally Accepted Accounting Principles (GAAP)</li>
                                <li>The General Framework Of International Accounting Standards In The Government Sector, IPSAS</li>
                                <li>Requirements For Applying The International Government Accounting Standards (IPSAS) in Government Institutions</li>
                                <li>Analytical Reference Of Accounts Using The Computer</li>
                                <li>Advanced Financial Analysis Skills Using Advanced Excel Applications</li>
                                <li><strong>Advanced Auditing Skills:</strong></li>
                                <li>Analyzing And Reviewing Accounting Databases Using A Computer</li>
                                <li>Practical Applications And Cases On Reviewing And Analyzing Accounts Electronically</li>
                            </ul>
                        </div>
                    ",
                    ],
                ],
            ],
        ];
    }
}
