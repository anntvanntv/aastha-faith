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
        'title_change2' => [
            'type' => 'text',
            'label' => 'Title Change 2',
        ],
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
$rm->addFieldToTemplate('album_card', 'home');
$rm->addFieldToTemplate('album_card_date', 'repeater_album_card');
$rm->addFieldToTemplate('born_title', 'home');
$rm->addFieldToTemplate('born_orange_title', 'home');
$rm->addFieldToTemplate('born_text', 'home');
$rm->addFieldToTemplate('born_image', 'home');
$rm->addFieldToTemplate('areas_cards', 'home');
$rm->addFieldToTemplate('title_change2', 'home');
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
if ($ti !== false && $si !== false && $t2i !== false && !($si === $ti + 1 && $t2i === $ti + 2)) {
    $homeFg->insertAfter($fields->get('stats_cards'), $fields->get('title_change'));
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
    ],
]);

$footerFields = [
    'footer_address',
    'footer_phone_code',
    'footer_phone',
    'footer_email',
    'footer_email2',
    'footer_facebook',
    'footer_instagram',
    'footer_vimeo',
    'footer_youtube',
    'footer_publications',
];

foreach($footerFields as $field){
    $rm->addFieldToTemplate($field, 'footer');
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



