<?php namespace ProcessWire;

if(!defined("PROCESSWIRE")) die();

/** @var ProcessWire $wire */

/**
 * ProcessWire Bootstrap API Ready
 * ===============================
 * This ready.php file is called during ProcessWire bootstrap initialization process.
 * This occurs after the current page has been determined and the API is fully ready
 * to use, but before the current page has started rendering. This file receives a
 * copy of all ProcessWire API variables.
 *
 */









$rm = $modules->get('RockMigrations');

$rm->createTemplate('past-projects');

$rm->createPage(
    template: 'past-projects',
    parent: '/',
    name: 'past-projects',
    title: 'Past Projects',
);

$rm->createTemplate('accountability');

$rm->createPage(
    template: 'accountability',
    parent: '/',
    name: 'accountability',
    title: 'Accountability',
);


$rm->createTemplate('partnership');

$rm->createPage(
    template: 'partnership',
    parent: '/',
    name: 'partnership',
    title: 'Partnership',
);




$rm->createTemplate('publications');

$publicationsPage = $rm->createPage(
    template: 'publications',
    parent: '/',
    name: 'publications',
);
if ($publicationsPage && !$publicationsPage->title) {
    $publicationsPage->setAndSave('title', 'Publications');
}

$rm->migrate([
    'fields' => [
        'publication_section1' => [
            'type' => 'text',
            'label' => 'Section 1 Title',
        ],
        'publication_section2' => [
            'type' => 'text',
            'label' => 'Section 2 Title',
        ],
        'pdf_file' => [
            'type' => 'file',
            'label' => 'Pdf File',
            'maxFiles' => 1,
            'extensions' => 'pdf',
            'outputFormat' => FieldtypeFile::outputFormatSingle,
        ],
        'cover_image' => [
            'type' => 'image',
            'label' => 'Cover Image',
            'maxFiles' => 1,
            'extensions' => 'jpg jpeg png webp',
            'outputFormat' => FieldtypeFile::outputFormatSingle,
        ],
        'booklet_cards' => [
            'type' => 'FieldtypeRepeater',
            'label' => 'Digital Booklets',
            'fields' => [
                'title',
                'pdf_file',
                'cover_image',
            ],
        ],
        'research_cards' => [
            'type' => 'FieldtypeRepeater',
            'label' => 'Case Studies and Research',
            'fields' => [
                'title',
                'pdf_file',
                'cover_image',
            ],
        ],
    ],
]);

$publicationsFields = [
    'publication_section1',
    'booklet_cards',
    'publication_section2',
    'research_cards',
];

foreach($publicationsFields as $field){
    $rm->addFieldToTemplate($field, 'publications');
}

$rm->removeFieldFromTemplate('pdf_cards', 'publications');
$rm->removeFieldFromTemplate('hero_title1', 'publications');
$rm->removeFieldFromTemplate('hero_description', 'publications');
$rm->removeFieldFromTemplate('cover_image', 'repeater_pdf_cards');

/* onestory fields must stay attached; re-attach if the fieldgroup lost them */
foreach (['image', 'category', 'date', 'body'] as $f) {
    $rm->addFieldToTemplate($f, 'onestory');
}



$rm->createTemplate('individual-giving');

$rm->createPage(
    template: 'individual-giving',
    parent: '/donors/',
    name: 'individual-giving',
    title: 'Individual Giving'
);

$rm->createPage(
    template: 'individual-giving',
    parent: '/donors/',
    name: 'institutional-funders',
    title: 'Institutional & Technical Funders'
);

$rm->createPage(
    template: 'individual-giving',
    parent: '/donors/',
    name: 'philanthropists',
    title: 'For Philanthropists'
);

$rm->createTemplate('donors');

$rm->createPage(
    template: 'donors',
    parent: '/',
    name: 'donors',
    title: 'Donors',
);

/*--- past projects -----*/

$rm->migrate([
    'fields' => [
        'projects_card' => [
            'type' => 'FieldtypeRepeater',
            'label' => 'Projects Card',
            'fields' => [
                'title_past_project',
                'budget_past_project',
                'duration_past_project',
                'target_past_project',
                'donor_past_project',
                'beneficiaries_past_project',
            ],
        ],
        'title_past_project' => [
            'type' => 'text',
            'label' => 'Title Past Project',
        ],
        'budget_past_project' => [
            'type' => 'text',
            'label' => 'Budget Past Project',
        ],
        'duration_past_project' => [
            'type' => 'text',
            'label' => 'Duration Past Project',
        ],
        'target_past_project' => [
            'type' => 'text',
            'label' => 'Target Past Project',
        ],
        'donor_past_project' => [
            'type' => 'text',
            'label' => 'Donor Past Project',
        ],
        'beneficiaries_past_project' => [
            'type' => 'text',
            'label' => 'Beneficiaries Past Project',
        ],

    ],
]);

$pastprojectsField = [
    'projects_card',
    'hero_title1'
];



forEach($pastprojectsField as $field) {
    $rm->addFieldToTemplate($field, 'past-projects');
}

/*  -----  about-us  ---- */

$rm->migrate([
    'fields' => [
        'hero_description2'=> [
            'type' => 'textArea',
            'label' => 'Hero Description2', 
        ],
        'description_about' => [
            'type' => 'textArea',
            'label' => 'Description About',
        ],
        'description_again' => [
            'type' => 'textArea',
            'label' => 'Description Again',
        ],
        'image_description3' => [
            'type' => 'text',
            'label' => 'Image Description3'        
        
        ],
        'text_pivotal' => [
            'type' => 'textArea',
            'label' => 'Text Pivotal'
        ],
        'image_description4' => [
            'type' => 'text',
            'label' => 'Image Description4',
        ],
        'about_card' => [
            'type' => 'FieldtypeRepeater',
            'label' => 'About Card',
            'fields' => [
                'image_about_card',
                'about_card_name',
                'about_card_job',
                'about_card_function',
                'about_card_ghibli',
                'about_card_back',

            ],
        ],
        'about_card_job' => [
            'type' => 'text',
            'label' => 'About Card Job',
        ],
        'image_about_card' => [
            'type' => 'FieldtypeImage',
            'label' => 'Image About Card',
            'maxFiles' => 1,
            'extensions' => 'jpg jpeg png gif svg',
            'outputFormat' => FieldtypeFile::outputFormatSingle,


        ],
        'about_card_name' => [
            'type' => 'text',
            'label' => 'About Card Name',
        ],
        'about_card_function' => [
            'type' => 'text',
            'label' => 'About Card Function',
        ],
        'about_card_ghibli' => [
            'type' => 'FieldtypeImage',
            'label' => 'Card Back Image (Ghibli-style portrait)',
            'description' => 'Shown on the back of the card when it flips. If empty, the front photo is reused.',
            'maxFiles' => 1,
            'extensions' => 'jpg jpeg png gif svg webp',
            'outputFormat' => FieldtypeFile::outputFormatSingle,
        ],
        'about_card_back' => [
            'type' => 'textarea',
            'label' => 'Card Back Text',
            'description' => 'Optional text shown under the back image when the card flips.',
            'rows' => 3,
        ],


    ],
]);

$aboutusFields = [
    'hero_title1',
    'born_orange_title',
    'born_image',
    'image_description',
    'hero_description',
    'hero_description2',
    'hero_title2',
    'description_about',
    'quote_image',
    'image_description2',
    'hero_title3',
    'description_again',
    'image',
    'image_description3',
    'title_content',
    'text_pivotal',
    'hero_image',
    'image_description4',
    'title_change',
    'about_card',
   

];

forEach($aboutusFields as $field) {
    $rm->addFieldToTemplate($field, 'about-us');
}



/*  fields accountability  */

/*  new fields   */

 $rm->migrate([
    'fields' => [
        'image_description' => [
            'type' => 'text',
            'label' => 'Image Description'        
        
        ],
         'image_description2' => [
            'type' => 'text',
            'label' => 'Image Description2'        
        
        ],
        'card_title10' => [
            'type' => 'text',
            'label' => 'Card Title10'
        ],
        'account_cards' => [
            'type' => 'FieldtypeRepeater',
            'label'=> 'Account Cards',
            'fields' => [
                'account_card_name',
                'account_card_function',
                'member_type',
            ],
        ],
        'account_card_name' => [
            'type' => 'text',
            'label' => 'Account Card Name',
        ],
        'account_card_function' => [
            'type' => 'text',
            'label' => 'Account Card Function',
        ],
        'member_type' => [
            'type' => 'options',
            'label' => 'Member Type',
            'options' => [
                2 => 'board|Board Member', 
                1 => 'executive|Executive Team',
            ],
        ],
        'pdf_cards' => [
            'type' => 'FieldtypeRepeater',
            'label' => 'Pdf Cards',
            'fields' => [
                'title',
                'pdf_file',
                'info_type',
            ],
            'collapsed' => Inputfield::collapsedYes,
        ],
        'pdf_file' => [
            'type' => 'file',
            'label' => 'Pdf File',
            'maxFiles' => 1,
            'extensions' => 'pdf',
            'outputFormat' => FieldtypeFile::outputFormatSingle,
        ],
        'info_type' => [
            'type' => 'options',
            'label' => 'Info Type',
            'options' => [
                1 => 'annual|Annual Reports',
                2 => 'financial|Financial Statements',
                3 => 'policy|Policy Documents',
                4 => 'registrations|Registrations & Certifications',
                5 => 'affiliations|Legal Affiliations',
            ],
        ],
        'cards_annual' => [
            'type' => 'FieldtypeRepeater',
            'label' => 'Annual Reports',
            'fields' => ['title', 'pdf_file'],
        ],
        'cards_financial' => [
            'type' => 'FieldtypeRepeater',
            'label' => 'Financial Statements',
            'fields' => ['title', 'pdf_file'],
        ],
        'cards_registrations' => [
            'type' => 'FieldtypeRepeater',
            'label' => 'Registrations & Certifications',
            'fields' => ['title', 'pdf_file'],
        ],
        'cards_affiliations' => [
            'type' => 'FieldtypeRepeater',
            'label' => 'Legal Affiliations',
            'fields' => ['title', 'pdf_file'],
        ],
        'cards_policy' => [
            'type' => 'FieldtypeRepeater',
            'label' => 'Policy Documents',
            'fields' => ['title', 'pdf_file'],
        ],
    ],        
 
    ]); 


/* all the fields in accountability   */

   $accountabilityFields = [
            'hero_title1',
            'born_orange_title',
            'hero_description',
            'born_image',
            'image_description',
            'hero_image',
            'image_description2',
            'title',
            'card_title',
            'card_number',
            'card_title2',
            'card_title3',
            'card_title4',
            'areas_title',
            'hero_title2',
            'account_cards',
            'pdf_cards',
            'card_number4',
            'cards_annual',
            'cards_financial',
            'cards_registrations',
            'cards_affiliations',
            'cards_policy',
   
        ]; 

forEach($accountabilityFields as $field){
    $rm->addFieldToTemplate($field, 'accountability');
}

/* one-time: move pdf_cards items into per-subsection card fields (skips fields already populated) */
$accPage = $pages->get("template=accountability");
if ($accPage->id && count($accPage->pdf_cards)) {
    $accPage->of(false);
    $cardFieldMap = [
        1 => 'cards_annual',
        2 => 'cards_financial',
        3 => 'cards_policy',
        4 => 'cards_registrations',
        5 => 'cards_affiliations',
    ];
    foreach ($cardFieldMap as $typeId => $fieldName) {
        $target = $accPage->get($fieldName);
        if (!$target || count($target)) continue;
        foreach ($accPage->pdf_cards as $c) {
            if ((int) $c->info_type->id !== $typeId) continue;
            $item = $accPage->$fieldName->getNew();
            $item->title = $c->title;
            $item->save();
            if ($c->pdf_file) $item->pdf_file->add($c->pdf_file->filename);
            $item->save();
            $accPage->$fieldName->add($item);
        }
        if (count($accPage->$fieldName)) $accPage->save($fieldName);
    }
}



/* fields our-work  */

$rm->migrate([
    'fields' => [
        'image_left' => [
            'type' => 'image',
            'label' => 'Image Left',
            'maxFiles' => 1,
            'extensions' => 'jpg jpeg png gif svg',
            'outputFormat' => FieldtypeFile::outputFormatSingle,

            ],
        'title_content' => [
            'type' => 'text',
            'label' => 'Title Content',
        ],
    ]
]);

/*  fields home and impact  */

$rm->migrate([
    'fields' => [
        'card_title9' => [
            'type' => 'text',
            'label' => 'Card Title9'
        ],
        'card_number9' => [
            'type' => 'text',
            'label' => 'Card Number9'
        ],
        'card_title8' => [
            'type' => 'text',
            'label' => 'Card Title8'
        ],
        'card_number8' => [
            'type' => 'text',
            'label' => 'Card Number8'
        ],
        'card_title7' => [
            'type' => 'text',
            'label' => 'Card Title7'
        ],
        'card_number7' => [
            'type' => 'text',
            'label' => 'Card Number7'
        ],
        'card_title6' => [
            'type' => 'text',
            'label' => 'Card Title6'
        ],
        'card_number6' => [
            'type' => 'text',
            'label' => 'Card Number6'
        ],
        'card_title5' => [
            'type' => 'text',
            'label' => 'Card Title5'
        ],
        'card_number5' => [
            'type' => 'text',
            'label' => 'Card Number5'
        ],
        'card_number10' => [
            'type' => 'text',
            'label' => 'Card Number10'
        ],
        'card_title11' => [
            'type' => 'text',
            'label' => 'Card Title11'
        ],
        'card_number11' => [
            'type' => 'text',
            'label' => 'Card Number11'
        ],
        'card_title12' => [
            'type' => 'text',
            'label' => 'Card Title12'
        ],
        'card_number12' => [
            'type' => 'text',
            'label' => 'Card Number12'
        ],
        'card_title13' => [
            'type' => 'text',
            'label' => 'Card Title13'
        ],
        'card_number13' => [
            'type' => 'text',
            'label' => 'Card Number13'
        ],
        'card_title14' => [
            'type' => 'text',
            'label' => 'Card Title14'
        ],
        'card_number14' => [
            'type' => 'text',
            'label' => 'Card Number14'
        ],
        'card_title15' => [
            'type' => 'text',
            'label' => 'Card Title15'
        ],
        'card_number15' => [
            'type' => 'text',
            'label' => 'Card Number15'
        ],
        'quote_image' => [
            'type' => 'image',
            'label' => 'Quote Image',
            'maxFiles' => 1,
            'extensions' => 'jpg jpeg png gif svg',
            'outputFormat' => FieldtypeFile::outputFormatSingle,
        ],

        'born_title' => [
            'type' => 'text',
            'label' => 'Born Title',
        ],
        'born_orange_title' => [
            'type' => 'text',
            'label' => 'Born Orange Title',
        ],
        // 'title_change2' — Find-us heading moved to contact page as contact_findus_title;
        // detached from home below; field + data stay preserved
        // 'title_change2' => [
        //     'type' => 'text',
        //     'label' => 'Title Change 2',
        // ],
        'born_image' => [
            'type' => 'image',
            'label' => 'Born Image',
            'maxFiles' => 1,
            'extensions' => 'jpg jpeg png gif svg',
            'outputFormat' => FieldtypeFile::outputFormatSingle,
        ],
        'areas_title' => [
            'type' => 'text',
            'label' => 'Areas Title',
        ],
        'areas_orange_title' => [
            'type' => 'text',
            'label' => 'Areas Orange Title',
        ],
       'areas_cards' => [
        'type' => 'FieldtypeRepeater',
        'label' => 'Areas Cards',

        'fields' => [
            'areas_card_image',
            'areas_card_title',
            'areas_card_text',
        ] 
       ],
        'areas_card_image' => [
                'type' => 'image',
                'label' => 'Areas Card Image',
                'maxFiles' => 1,
                'extensions' => 'jpg jpeg png gif svg',
                'outputFormat' => FieldtypeFile::outputFormatSingle,
        ],
        'areas_card_title' => [
                'type' => 'text',
                'label' => 'Areas Card Title',
        ],
        'areas_card_text' => [
                'type' => 'textarea',
                'label' => 'Areas Card Text',
        ],
        'stats_cards' => [
            'type' => 'FieldtypeRepeater',
            'label' => 'Stats Cards',
            'fields' => [
                'stat_number',
                'stat_title',
            ],
        ],
        'stat_number' => [
            'type' => 'text',
            'label' => 'Stat Number',
        ],
        'stat_title' => [
            'type' => 'text',
            'label' => 'Stat Title',
        ],
        'hero_slides' => [
            'type' => 'FieldtypeImage',
            'label' => 'Hero Slideshow Images',
            'description' => 'Upload multiple photos — they auto-rotate every 3 seconds. When empty, the single Hero image above is used instead.',
            'maxFiles' => 0,
            'extensions' => 'jpg jpeg png gif svg webp',
            'outputFormat' => FieldtypeFile::outputFormatArray,
        ],
        'field_title' => [
            'type' => 'text',
            'label' => 'Latest News Title',
        ],
        'album_card' => [
            'type' => 'FieldtypeRepeater',
            'label' => 'Album Card',
            'fields' => [
                'album_card_image',
                'album_card_title',
                'album_card_text',
                'album_card_date',
            ],
        ],
        'album_card_date' => [
            'type' => 'datetime',
            'label' => 'News Date',
        ],
        'date' => [
            'type' => 'datetime',
            'label' => 'Date',
            'defaultToday' => 1,
            'notes' => 'Publication date. Leave empty to use the creation date automatically. Example: September 23, 2026',
        ],
        'album_card_image' => [
            'type' => 'FieldtypeImage',
            'label' => 'Album Card Image',
            'maxFiles' => 1,
            'extensions' => 'jpg jpeg png gif svg',
            'outputFormat' => FieldtypeFile::outputFormatSingle,
        ],
        'album_card_title' => [
            'type' => 'text',
            'label' => 'Album Card Title',
        ],
        'album_card_text' => [
            'type' => 'textarea',
            'label' => 'Album Card Text',
        ],
        'objective' => [
            'type' => 'textarea',
            'label' => 'Objective',
        ],
        'outputs' => [
            'type' => 'textarea',
            'label' => 'Outputs',
        ],
        'duration' => [
            'type' => 'text',
            'label' => 'Duration',
        ],
        'donor' => [
            'type' => 'text',
            'label' => 'Donor',
        ],
        'project_areas' => [
            'type' => 'text',
            'label' => 'Project Areas',
        ],
        'budget' => [
            'type' => 'text',
            'label' => 'Budget',
        ],
        'quote_text' => [
            'type' => 'textarea',
            'label' => 'Quote Text',
        ],
        'quote_title' => [
            'type' => 'text',
            'label' => 'Quote Title',
        ],
        'quote_subtitle' => [
            'type' => 'text',
            'label' => 'Quote Subtitle',
        ],
        // Quote2 fields — mirrors quote fields for the second quote section (#quote2) on homepage
        'quote2_image' => [
            'type' => 'image',
            'label' => 'Quote2 Image',
            'maxFiles' => 1,
            'extensions' => 'jpg jpeg png gif svg',
            'outputFormat' => FieldtypeFile::outputFormatSingle,
        ],
        'quote2_text' => [
            'type' => 'textarea',
            'label' => 'Quote2 Text',
        ],
        'quote2_title' => [
            'type' => 'text',
            'label' => 'Quote2 Title',
        ],
        'quote2_subtitle' => [
            'type' => 'text',
            'label' => 'Quote2 Subtitle',
        ],

        'logos' => [
            'type' => 'FieldtypeImage',
            'label' => 'Logos',
            'maxFiles' => 0,
            'extensions' => 'jpg jpeg png gif svg',
            'outputFormat' => FieldtypeFile::outputFormatArray,
        ],
    
        
       
    ]

]);

$rm->addFieldToTemplate('logos', 'home');
$rm->addFieldToTemplate('quote_image', 'home');
$rm->addFieldToTemplate('quote_subtitle', 'home');
$rm->addFieldToTemplate('quote_title', 'home');
$rm->addFieldToTemplate('quote_text', 'home');
// Quote2 fields — for second quote section on homepage
$rm->addFieldToTemplate('quote2_image', 'home');
$rm->addFieldToTemplate('quote2_text', 'home');
$rm->addFieldToTemplate('quote2_title', 'home');
$rm->addFieldToTemplate('quote2_subtitle', 'home');
// album_card moved to /news/ page — detach from home (news is managed on the news page itself)
// $rm->addFieldToTemplate('album_card', 'home');
$rm->addFieldToTemplate('album_card_date', 'repeater_album_card');
$homeT = $templates->get('home');
if ($homeT && $homeT->fields->has('album_card')) {
    $homeT->fields->remove('album_card');
    $homeT->fields->save();
}
$rm->addFieldToTemplate('born_title', 'home');
$rm->addFieldToTemplate('born_orange_title', 'home');
$rm->addFieldToTemplate('born_text', 'home');
$rm->addFieldToTemplate('born_image', 'home');
$rm->addFieldToTemplate('areas_cards', 'home');
// $rm->addFieldToTemplate('title_change2', 'home'); // Find-us heading moved to contact (contact_findus_title)
// detach from home — section is commented out; field + data stay preserved on the field itself
$_homeFgT2 = $templates->get('home')->fieldgroup;
if ($_homeFgT2->has('title_change2')) {
    $_homeFgT2->remove($fields->get('title_change2'));
    $_homeFgT2->save();
}
$rm->addFieldToTemplate('stats_cards', 'home');
$rm->addFieldToTemplate('hero_slides', 'home');

// Group home stats fields together in admin and push legacy card_* fields to the end.
// Guarded: only touches the fieldgroup when the order is actually wrong.
$homeFg = $templates->get('home')->fieldgroup;
$names = [];
foreach ($homeFg as $f) $names[] = $f->name;
$dirty = false;

$ti = array_search('title_change', $names, true);
$si = array_search('stats_cards', $names, true);
$t2i = array_search('title_change2', $names, true);
if ($ti !== false && $si !== false && $si !== $ti + 1) {
    $homeFg->insertAfter($fields->get('stats_cards'), $fields->get('title_change'));
    $dirty = true;
}
// title_change2 detached from home (moved to contact) — order it after stats_cards only while still attached
if ($t2i !== false && $si !== false && $t2i !== $si + 1) {
    $homeFg->insertAfter($fields->get('title_change2'), $fields->get('stats_cards'));
    $dirty = true;
}

$hi = array_search('hero_image', $names, true);
$hs = array_search('hero_slides', $names, true);
if ($hi !== false && $hs !== false && $hs !== $hi + 1) {
    $homeFg->insertAfter($fields->get('hero_slides'), $fields->get('hero_image'));
    $dirty = true;
}

$legacy = ['card_number','card_title','card_number2','card_title2','card_number3','card_title3','card_number4','card_title4'];
$present = array_values(array_intersect($legacy, $names));
if ($present && array_slice($names, -count($present)) !== $present) {
    foreach ($present as $cf) {
        $f = $fields->get($cf);
        $homeFg->remove($f);
        $homeFg->add($f);
    }
    $dirty = true;
}

if ($dirty) $homeFg->save();

/* Coverage map on home — districts highlighted with hover metrics */
$rm->migrate([
    'fields' => [
        'map_title' => [
            'type' => 'text',
            'label' => 'Coverage Section Title',
        ],
        'map_district' => [
            'type' => 'FieldtypeRepeater',
            'label' => 'Coverage Map Districts',
            'fields' => ['map_district_sel', 'map_district_metric', 'map_district_completed'],
        ],
        'map_district_sel' => [
            'type' => 'options',
            'label' => 'District',
            'options' => [
                1 => 'achham|Achham',
                2 => 'arghakhanchi|Arghakhanchi',
                3 => 'baglung|Baglung',
                4 => 'baitadi|Baitadi',
                5 => 'bajhang|Bajhang',
                6 => 'bajura|Bajura',
                7 => 'banke|Banke',
                8 => 'bara|Bara',
                9 => 'bardiya|Bardiya',
                10 => 'bhaktapur|Bhaktapur',
                11 => 'bhojpur|Bhojpur',
                12 => 'chitawan|Chitawan',
                13 => 'dadeldhura|Dadeldhura',
                14 => 'dailekh|Dailekh',
                15 => 'dang|Dang',
                16 => 'darchula|Darchula',
                17 => 'dhading|Dhading',
                18 => 'dhankuta|Dhankuta',
                19 => 'dhanusha|Dhanusha',
                20 => 'dolakha|Dolakha',
                21 => 'dolpa|Dolpa',
                22 => 'doti|Doti',
                23 => 'gorkha|Gorkha',
                24 => 'gulmi|Gulmi',
                25 => 'humla|Humla',
                26 => 'ilam|Ilam',
                27 => 'jajarkot|Jajarkot',
                28 => 'jhapa|Jhapa',
                29 => 'jumla|Jumla',
                30 => 'kabhrepalanchok|Kabhrepalanchok',
                31 => 'kailali|Kailali',
                32 => 'kalikot|Kalikot',
                33 => 'kanchanpur|Kanchanpur',
                34 => 'kapilbastu|Kapilbastu',
                35 => 'kaski|Kaski',
                36 => 'kathmandu|Kathmandu',
                37 => 'khotang|Khotang',
                38 => 'lalitpur|Lalitpur',
                39 => 'lamjung|Lamjung',
                40 => 'mahottari|Mahottari',
                41 => 'makawanpur|Makawanpur',
                42 => 'manang|Manang',
                43 => 'morang|Morang',
                44 => 'mugu|Mugu',
                45 => 'mustang|Mustang',
                46 => 'myagdi|Myagdi',
                47 => 'nawalpur|Nawalpur',
                48 => 'nuwakot|Nuwakot',
                49 => 'okhaldhunga|Okhaldhunga',
                50 => 'palpa|Palpa',
                51 => 'panchthar|Panchthar',
                52 => 'parasi|Parasi',
                53 => 'parbat|Parbat',
                54 => 'parsa|Parsa',
                55 => 'pyuthan|Pyuthan',
                56 => 'ramechhap|Ramechhap',
                57 => 'rasuwa|Rasuwa',
                58 => 'rautahat|Rautahat',
                59 => 'rolpa|Rolpa',
                60 => 'rukum_east|Rukum East',
                61 => 'rukum_west|Rukum West',
                62 => 'rupandehi|Rupandehi',
                63 => 'salyan|Salyan',
                64 => 'sankhuwasabha|Sankhuwasabha',
                65 => 'saptari|Saptari',
                66 => 'sarlahi|Sarlahi',
                67 => 'sindhuli|Sindhuli',
                68 => 'sindhupalchok|Sindhupalchok',
                69 => 'siraha|Siraha',
                70 => 'solukhumbu|Solukhumbu',
                71 => 'sunsari|Sunsari',
                72 => 'surkhet|Surkhet',
                73 => 'syangja|Syangja',
                74 => 'tanahu|Tanahu',
                75 => 'taplejung|Taplejung',
                76 => 'terhathum|Terhathum',
                77 => 'udayapur|Udayapur',
                78 => 'nawalparasi|Nawalparasi (East + West)',
            ],
        ],
        'map_district_metric' => [
            'type' => 'textarea',
            'label' => 'District Metrics',
            'notes' => 'One metric per line — each line shows as a separate row in the hover tooltip.',
        ],
        'map_district_completed' => [
            'type' => 'checkbox',
            'label' => 'Completed',
            'notes' => 'Reserved for future use (e.g. completed vs ongoing projects).',
        ],
    ],
]);
$rm->addFieldToTemplate('map_title', 'home');
$rm->addFieldToTemplate('map_district', 'home');

// fill empty coverage title (admin-entered values are kept) — front-end only,
// writing during an admin save collides with PagesEditor
$homePage = $pages->get('/');
if ($page->template->name !== 'admin' && $homePage->id && $homePage->hasField('map_title') && trim($homePage->map_title ?? '') === '') {
    try {
        $prevOf = $homePage->of();
        $homePage->of(false);
        $homePage->map_title = 'Our Reach';
        $homePage->save('map_title');
        $homePage->of($prevOf);
    } catch (\Throwable $e) {
        wire('log')->save('errors', 'map_title seed failed: ' . $e->getMessage());
    }
}
$rm->addFieldToTemplate('map_district_sel', 'repeater_map_district');
$rm->addFieldToTemplate('map_district_metric', 'repeater_map_district');
$rm->addFieldToTemplate('map_district_completed', 'repeater_map_district');

// migrate old free-text map_district_name values into the select, then drop the old field
// (writes repeater items — front-end only so it can't collide with an admin save)
$repT = $templates->get('repeater_map_district');
if ($page->template->name !== 'admin' && $repT && $repT->fieldgroup->has('map_district_name')) {
    $selField = $fields->get('map_district_sel');
    $optByTitle = [];
    if ($selField) {
        foreach ($selField->type->getOptions($selField) as $opt) {
            $optByTitle[strtoupper(preg_replace('/[^A-Z]/i', '', $opt->title))] = $opt->id;
        }
    }
    // legacy spellings from the old district list
    $selAliases = ['CHITWAN' => 'CHITAWAN', 'MAKWANPUR' => 'MAKAWANPUR', 'NAWALPARASI' => 'NAWALPARASIEASTWEST'];
    try {
        foreach ($pages->get('/')->map_district as $row) {
            $old = strtoupper(preg_replace('/[^A-Z]/i', '', $row->map_district_name ?? ''));
            $existing = $row->map_district_sel;
            if (!$old || ($existing && $existing->id)) continue;
            $key = $selAliases[$old] ?? $old;
            if (isset($optByTitle[$key])) {
                $row->of(false);
                $row->map_district_sel = $optByTitle[$key];
                $row->save('map_district_sel');
            }
        }
    } catch (\Throwable $e) {
        wire('log')->save('errors', 'map_district_sel migration failed: ' . $e->getMessage());
    }
    $repT->fieldgroup->remove('map_district_name');
    $repT->fieldgroup->save();
    if ($fields->get('map_district_name')) $fields->delete($fields->get('map_district_name'));
}

// Seed coverage districts once — only when the repeater is empty (front-end only)
$dummyMetrics = "Ongoing projects";
if ($page->template->name !== 'admin' && $homePage->id && $homePage->hasField('map_district') && !count($homePage->map_district)) {
    // district name => completed flag (reserved)
    $seedDistricts = [
        'Lalitpur' => 1, 'Kathmandu' => 1, 'Sunsari' => 0, 'Morang' => 0,
        'Makwanpur' => 0, 'Bara' => 0, 'Banke' => 0, 'Bhaktapur' => 1,
        'Chitwan' => 0, 'Kaski' => 1, 'Tanahu' => 0, 'Kailali' => 0,
        'Nawalparasi' => 0, 'Parsa' => 0, 'Kanchanpur' => 0, 'Saptari' => 0,
        'Rupandehi' => 0, 'Surkhet' => 0, 'Mahottari' => 0, 'Dailekh' => 0,
        'Dang' => 0, 'Dhankuta' => 0, 'Gorkha' => 0, 'Sindhupalchok' => 0,
        'Syangja' => 0,
    ];
    $selField = $fields->get('map_district_sel');
    $optByTitle = [];
    if ($selField) {
        foreach ($selField->type->getOptions($selField) as $opt) {
            $optByTitle[strtoupper(preg_replace('/[^A-Z]/i', '', $opt->title))] = $opt->id;
        }
    }
    $selAliases = ['CHITWAN' => 'CHITAWAN', 'MAKWANPUR' => 'MAKAWANPUR', 'NAWALPARASI' => 'NAWALPARASIEASTWEST'];
    $prevOf = $homePage->of();
    try {
        $homePage->of(false);
        foreach ($seedDistricts as $dn => $completed) {
            $row = $homePage->map_district->getNewItem();
            $key = $selAliases[strtoupper($dn)] ?? strtoupper($dn);
            if (isset($optByTitle[$key])) $row->map_district_sel = $optByTitle[$key];
            $row->map_district_metric = $dummyMetrics;
            $row->map_district_completed = $completed;
            $row->of(false);
            $row->save();
        }
        $homePage->save('map_district');
        $homePage->of($prevOf);
    } catch (\Throwable $e) {
        $homePage->of($prevOf);
        wire('log')->save('errors', 'map_district seed failed: ' . $e->getMessage());
    }
}

// keep the map fields in page order in admin — after the Find-us section fields
$names = [];
foreach ($homeFg as $f) $names[] = $f->name;
$anchor = array_search('title_change2', $names, true) !== false ? 'title_change2' : 'stats_cards';
$ai = array_search($anchor, $names, true);
$mti = array_search('map_title', $names, true);
$mdi = array_search('map_district', $names, true);
if ($ai !== false && $mti !== false && $mdi !== false && !($mti === $ai + 1 && $mdi === $ai + 2)) {
    $homeFg->insertAfter($fields->get('map_title'), $fields->get($anchor));
    $homeFg->insertAfter($fields->get('map_district'), $fields->get('map_title'));
    $homeFg->save();
}

/* adding Field to Template OUR-WORK  */
// Section titles for the two sections on Our Work page
$rm->migrate([
    'fields' => [
        'change_section_title' => [
            'type' => 'text',
            'label' => 'Change Section Title',
        ],
        'projects_section_title' => [
            'type' => 'text',
            'label' => 'Projects Section Title',
        ],
    ],
]);
$rm->addFieldToTemplate('image_left', 'our-work');
$rm->addFieldToTemplate('title_content', 'our-work');
$rm->addFieldToTemplate('areas_cards', 'our-work');
$rm->addFieldToTemplate('change_section_title', 'our-work');
$rm->addFieldToTemplate('projects_section_title', 'our-work');


/* adding Fields to Template INDIVIDUAL-GIVING */

$rm->addFieldToTemplate('title', 'individual-giving');
$rm->addFieldToTemplate('hero_description', 'individual-giving');
$rm->addFieldToTemplate('card_number', 'donors');
$rm->addFieldToTemplate('card_number2', 'donors');
$rm->addFieldToTemplate('card_number3', 'donors');
$rm->addFieldToTemplate('card_number4', 'donors');
$rm->addFieldToTemplate('card_title', 'donors');
$rm->addFieldToTemplate('born_title', 'donors');
$rm->removeFieldFromTemplate('card_number', 'individual-giving');
$rm->removeFieldFromTemplate('card_number2', 'individual-giving');
$rm->removeFieldFromTemplate('card_number3', 'individual-giving');
$rm->removeFieldFromTemplate('card_number4', 'individual-giving');
$rm->removeFieldFromTemplate('card_title', 'individual-giving');
$rm->removeFieldFromTemplate('born_title', 'individual-giving');


/* adding Fields to Template IMPACT */


$impactFields = [
    'hero_title1',
    'born_orange_title',
    'hero_description',
    'hero_image',
    'hero_title2',
    'card_number',
    'card_title',
    'card_number2',
    'card_title2',
    'card_number3',
    'card_title3',
    'card_number4',  
    'card_title4',
    'areas_title',
    'card_number5',
    'card_title5',
    'card_number6',
    'card_title6',
    'card_number7',
    'card_title7',
    'card_number8',
    'card_title8',
    'card_number9',
    'card_title9',
    'card_number10',
    'card_title10',
    'card_number11',
    'card_title11',
    'card_number12',
    'card_title12',
    'card_number13',
    'card_title13',
    'card_number14',
    'card_title14',
    'card_number15',
    'card_title15',


];

forEach($impactFields as $field){
    $rm->addFieldToTemplate($field, 'impact');
}

/* keep admin field order matching the list above; only write when order differs */
$impactFg = wire('templates')->get('impact')->fieldgroup;
$fieldOrder = [];
foreach($impactFg as $fgField) $fieldOrder[] = $fgField->name;

$prevField = null;
$orderChanged = false;
foreach($impactFields as $field){
    if($prevField){
        $i = array_search($field, $fieldOrder);
        $j = array_search($prevField, $fieldOrder);
        if($i !== false && $j !== false && $i !== $j + 1){
            $impactFg->insertAfter(wire('fields')->get($field), wire('fields')->get($prevField));
            $orderChanged = true;
            $fieldOrder = [];
            foreach($impactFg as $fgField) $fieldOrder[] = $fgField->name;
        }
    }
    $prevField = $field;
}
if($orderChanged) $impactFg->save();

/*  -----  footer  ---- */

$rm->createTemplate('footer');

$rm->createPage(
    template: 'footer',
    parent: '/',
    name: 'footer',
    title: 'Footer',
    status: [Page::statusUnpublished],
);

$rm->migrate([
    'fields' => [
        'footer_facebook' => ['type' => 'text', 'label' => 'Facebook URL'],
        'footer_instagram' => ['type' => 'text', 'label' => 'Instagram URL'],
        'footer_vimeo' => ['type' => 'text', 'label' => 'Vimeo URL'],
        'footer_youtube' => ['type' => 'text', 'label' => 'YouTube URL'],
        'footer_email' => ['type' => 'text', 'label' => 'Primary Email'],
        'footer_email2' => ['type' => 'text', 'label' => 'Secondary Email'],
        'footer_phone_code' => ['type' => 'text', 'label' => 'Phone Country Code'],
        'footer_phone' => ['type' => 'text', 'label' => 'Phone Number'],
        'footer_address' => ['type' => 'text', 'label' => 'Address'],
        'footer_publications' => ['type' => 'text', 'label' => 'Publications Link'],
        'footer_tagline' => ['type' => 'text', 'label' => 'Tagline'],
        'contact_admin_email' => ['type' => 'text', 'label' => 'Admin Email (receives form submissions)'],
    ],
]);

$footerFields = [
    'footer_tagline',
    'footer_address',
    'footer_phone_code',
    'footer_phone',
    'footer_email',
    'footer_email2',
    // 'contact_admin_email', // moved to contact page — kept on footer too for now
    'footer_facebook',
    'footer_instagram',
    'footer_vimeo',
    'footer_youtube',
    'footer_publications',
];

foreach($footerFields as $field){
    $rm->addFieldToTemplate($field, 'footer');
}

// order: tagline right under title; admin email grouped with the email fields
$footerFg = $templates->get('footer')->fieldgroup;
if ($footerFg->has('footer_tagline') && $footerFg->has('title')) {
    $names = [];
    foreach ($footerFg as $f) $names[] = $f->name;
    if (array_search('footer_tagline', $names) !== array_search('title', $names) + 1) {
        $footerFg->insertAfter($fields->get('footer_tagline'), $fields->get('title'));
        $footerFg->save();
    }
}
// contact_admin_email ordering on footer — field moved to contact page; detach disabled
// if ($footerFg->has('contact_admin_email') && $footerFg->has('footer_email2')) {
//     $names = [];
//     foreach ($footerFg as $f) $names[] = $f->name;
//     if (array_search('contact_admin_email', $names) !== array_search('footer_email2', $names) + 1) {
//         $footerFg->insertAfter($fields->get('contact_admin_email'), $fields->get('footer_email2'));
//         $footerFg->save();
//     }
// }
// if ($footerFg->has('contact_admin_email')) {
//     $footerFg->remove($fields->get('contact_admin_email'));
//     $footerFg->save();
// }

// seed footer tagline once (only when empty — respects admin edits)
$footerPg = $pages->get('/footer/');
if ($footerPg->id && !$footerPg->footer_tagline) {
    $prevOf = $footerPg->of();
    try {
        $footerPg->of(false);
        $footerPg->footer_tagline = 'Feminist Approaches in Transforming Health. Women-led. Community-rooted. Internationally trusted.';
        $footerPg->save('footer_tagline');
    } catch (\Throwable $e) {
        wire()->log->error('footer_tagline seed failed: ' . $e->getMessage());
    }
    $footerPg->of($prevOf);
}

// seed contact admin email on footer page once (legacy location — field moved to contact page)
// if ($footerPg->id && $footerPg->template->hasField('contact_admin_email') && !$footerPg->contact_admin_email) {
//     $prevOf = $footerPg->of();
//     try {
//         $footerPg->of(false);
//         $footerPg->contact_admin_email = 'faithinitiative@gmail.com';
//         $footerPg->save('contact_admin_email');
//     } catch (\Throwable $e) {
//         wire()->log->error('contact_admin_email seed failed: ' . $e->getMessage());
//     }
//     $footerPg->of($prevOf);
// }


/*  -----  contact form submissions  ---- */

$rm->migrate([
    'fields' => [
        'contact_name' => ['type' => 'text', 'label' => 'Name'],
        'contact_email' => ['type' => 'text', 'label' => 'Email'],
        'contact_phone' => ['type' => 'text', 'label' => 'Phone'],
        'contact_subject' => ['type' => 'text', 'label' => 'Subject'],
        'contact_group' => ['type' => 'text', 'label' => 'Group'],
        'contact_message' => ['type' => 'textarea', 'label' => 'Message'],
        'contact_nepal_address' => ['type' => 'textarea', 'label' => 'Nepal Office Address'],
        'contact_germany_address' => ['type' => 'textarea', 'label' => 'Germany Office Address'],
        'contact_office_phone' => ['type' => 'text', 'label' => 'Phone Number'],
        'contact_office_email' => ['type' => 'text', 'label' => 'Email Address'],
        'contact_findus_title' => ['type' => 'text', 'label' => 'Find Us Section Title'],
    ],
]);

// contact page fields — under title, in page order (find-us heading, nepal, germany, phone, email, admin email)
$contactFields = ['contact_findus_title', 'contact_nepal_address', 'contact_germany_address', 'contact_office_phone', 'contact_office_email', 'contact_admin_email'];
foreach ($contactFields as $cf) {
    $rm->addFieldToTemplate($cf, 'contact');
}
$contactFg = $templates->get('contact')->fieldgroup;
if ($contactFg->id) {
    $names = [];
    foreach ($contactFg as $f) $names[] = $f->name;
    $after = 'title';
    $needsOrder = false;
    foreach ($contactFields as $n) {
        if (array_search($n, $names) !== array_search($after, $names) + 1) { $needsOrder = true; break; }
        $after = $n;
    }
    if ($needsOrder) {
        $after = 'title';
        foreach ($contactFields as $n) {
            if ($contactFg->has($n) && $contactFg->has($after)) {
                $contactFg->insertAfter($fields->get($n), $fields->get($after));
            }
            $after = $n;
        }
        $contactFg->save();
    }
}

// seed contact page field values once (per-field, only when empty — respects admin edits)
// front-end only — writing during an admin save collides with PagesEditor
$contactPg = $pages->get('/contact/');
if ($page->template->name !== 'admin' && $contactPg->id) {
    $defaults = [
        'contact_findus_title' => 'Find us on Map',
        'contact_nepal_address' => "Chudabikram Street\nKupondole -1\nLalitpur 44600, Nepal",
        'contact_germany_address' => "Bornkampsweg 24\nAhrensburg 22926,\nGermany",
        'contact_office_phone' => '+977 01 5412012',
        'contact_office_email' => 'faithinitiative@gmail.com',
        'contact_admin_email' => 'faithinitiative@gmail.com',
    ];
    $prevOf = $contactPg->of();
    try {
        $contactPg->of(false);
        $dirty = false;
        foreach ($defaults as $k => $v) {
            if ($contactPg->template->hasField($k) && !$contactPg->get($k)) {
                $contactPg->set($k, $v);
                $dirty = true;
            }
        }
        if ($dirty) $contactPg->save();
    } catch (\Throwable $e) {
        wire()->log->error('contact page fields seed failed: ' . $e->getMessage());
    }
    $contactPg->of($prevOf);
}

$rm->createTemplate('contact_submission');
foreach (['contact_name', 'contact_email', 'contact_phone', 'contact_subject', 'contact_group', 'contact_message'] as $cf) {
    $rm->addFieldToTemplate($cf, 'contact_submission');
}

$rm->createTemplate('contact_submissions');
$rm->createPage(
    template: 'contact_submissions',
    parent: '/',
    name: 'contact-submissions',
    title: 'Contact Submissions',
    status: [Page::statusUnpublished],
);

// family: submission children only under the submissions parent (guarded — saves once)
$subParent = $templates->get('contact_submissions');
$subChild = $templates->get('contact_submission');
if ($subParent->id && $subChild->id) {
    if ($subParent->childTemplates != [$subChild->id]) {
        $subParent->childTemplates = [$subChild->id];
        $subParent->save();
    }
    if ($subChild->parentTemplates != [$subParent->id]) {
        $subChild->parentTemplates = [$subParent->id];
        $subChild->save();
    }
}

// submissions table on the Contact page edit form
if (!$modules->isInstalled('FieldtypePageTable')) {
    $modules->install('FieldtypePageTable');
}
$subListField = $fields->get('contact_submissions_list');
if (!$subListField) {
    $subListField = new Field();
    $subListField->type = 'FieldtypePageTable';
    $subListField->name = 'contact_submissions_list';
    $subListField->label = 'Form Submissions';
    $subListField->save();
}
$subParentPage = $pages->get('/contact-submissions/');
if ($subParentPage->id && $subChild->id) {
    $subListChanged = false;
    if ($subListField->parent_id != $subParentPage->id) {
        $subListField->parent_id = $subParentPage->id;
        $subListChanged = true;
    }
    if ($subListField->template_id != $subChild->id) {
        $subListField->template_id = $subChild->id;
        $subListChanged = true;
    }
    $wantCols = "title\ncontact_email\ncontact_phone\ncontact_subject\ncontact_group\ncreated";
    if ($subListField->columns !== $wantCols) {
        $subListField->columns = $wantCols;
        $subListChanged = true;
    }
    if ($subListField->sortfields !== '-created') {
        $subListField->sortfields = '-created';
        $subListChanged = true;
    }
    $subNotes = 'All submitted contact forms. Emails go to the Admin Email above. Local dev: view captured mail in Mailpit at :8025 (ddev mailpit).';
    if ($subListField->notes !== $subNotes) {
        $subListField->notes = $subNotes;
        $subListChanged = true;
    }
    if ($subListChanged) $subListField->save();
}
$rm->addFieldToTemplate('contact_submissions_list', 'contact');

// keep the submissions table in sync with the submission children (guarded — writes only on diff)
$contactPgForList = $pages->get('/contact/');
if ($subParentPage->id && $contactPgForList->id && $contactPgForList->template->hasField('contact_submissions_list')) {
    $kidIds = $pages->findIds("parent=$subParentPage->id, template=contact_submission");
    $haveIds = $contactPgForList->contact_submissions_list->explode('id');
    $missingIds = array_diff($kidIds, $haveIds);
    if ($missingIds) {
        $prevOf = $contactPgForList->of();
        try {
            $contactPgForList->of(false);
            foreach ($missingIds as $mid) {
                $contactPgForList->contact_submissions_list->add($pages->get((int) $mid));
            }
            $contactPgForList->save('contact_submissions_list');
        } catch (\Throwable $e) {
            wire()->log->error('contact_submissions_list sync failed: ' . $e->getMessage());
        }
        $contactPgForList->of($prevOf);
    }
}

// admin: submissions table is view-only — hide Add New and row delete
$isAdminReq = ($page && $page->template && $page->template->name === 'admin')
    || strpos($_SERVER['REQUEST_URI'] ?? '', $config->urls->admin) === 0;
if ($isAdminReq) {
    $config->styles->add($config->urls->templates . 'styles/admin.css');
}

/*  -----  donor path cards  ---- */

$rm->migrate([
    'fields' => [
        'donor_cards' => [
            'type' => 'FieldtypeRepeater',
            'label' => 'Donor Cards',
            'fields' => [
                'donor_card_icon',
                'donor_card_title',
                'donor_card_text',
                'donor_card_url',
            ],
        ],
        'donor_card_icon' => [
            'type' => 'image',
            'label' => 'Donor Card Icon',
            'maxFiles' => 1,
            'extensions' => 'jpg jpeg png gif svg',
            'outputFormat' => FieldtypeFile::outputFormatSingle,
        ],
        'donor_card_title' => [
            'type' => 'text',
            'label' => 'Donor Card Title',
        ],
        'donor_card_text' => [
            'type' => 'textArea',
            'label' => 'Donor Card Text',
        ],
        'donor_card_url' => [
            'type' => 'text',
            'label' => 'Donor Card URL',
        ],
        'cta_label' => [
            'type' => 'text',
            'label' => 'CTA Label',
        ],
        'cta_url' => [
            'type' => 'text',
            'label' => 'CTA URL',
        ],
    ],
]);

$rm->addFieldToTemplate('donor_cards', 'donors');
$rm->addFieldToTemplate('cta_label', 'individual-giving');
$rm->addFieldToTemplate('cta_url', 'individual-giving');

/*--- latest news ---*/

$rm->createTemplate('news');
$rm->createTemplate('onenews');
$rm->createPage(
    template: 'news',
    parent: '/',
    name: 'news',
    title: 'Latest News'
);
foreach (['image', 'date', 'body'] as $f) {
    $rm->addFieldToTemplate($f, 'onenews');
}

// onenews: default empty date to created timestamp (editors can still override)
$wire->addHookAfter('Pages::saved', function ($event) {
    $p = $event->arguments(0);
    if ($p->template->name !== 'onenews' || $p->date) return;
    $p->of(false);
    $p->date = $p->created ?: time();
    $p->save('date');
});

// onework: re-attach project fields detached when the fieldgroup was reset
// (data survives in the field tables — attaching makes it editable again)
foreach (['objective', 'outputs', 'duration', 'donor', 'project_areas', 'budget'] as $f) {
    $rm->addFieldToTemplate($f, 'onework');
}

// news page manages cards via the same album_card repeater as home
$rm->addFieldToTemplate('album_card', 'news');

// /news/{slug}/ renders detail from album_card row
$newsT = $templates->get('news');
if ($newsT && $newsT->id && !$newsT->urlSegments) {
    $newsT->urlSegments = 1;
    $newsT->save();
}

// migrate onenews children into /news/ album_card rows (idempotent, prod-safe)
$newsParent = $pages->get('/news/');
if ($newsParent->id && $newsParent->numChildren && !count($newsParent->album_card)) {
    $prevOf = $newsParent->of();
    try {
        $newsParent->of(false);
        foreach ($newsParent->children('sort=date') as $c) {
            $row = $newsParent->album_card->getNewItem();
            $row->album_card_title = $c->title;
            $row->album_card_date = $c->date;
            $row->album_card_text = $c->body;
            $img = $c->image;
            if ($img instanceof Pageimages) $img = count($img) ? $img->first() : null;
            $row->of(false);
            $row->save();
            if ($img && $img->filename) {
                $row->album_card_image = $img->filename;
                $row->save('album_card_image');
            }
        }
        $newsParent->save('album_card');
        $newsParent->of($prevOf);
    } catch (\Throwable $e) {
        $newsParent->of($prevOf);
        wire('log')->save('errors', 'album_card migration failed: ' . $e->getMessage());
    }
}



