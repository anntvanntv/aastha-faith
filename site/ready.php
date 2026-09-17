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

$rm->createTemplate('accountability');

$rm->createPage(
    template: 'accountability',
    parent: '/',
    name: 'accountability',
    title: 'Accountability',
);

$rm->createTemplate('partnership-volunteers');

$rm->createPage(
    template: 'partnership-volunteers',
    parent: '/',
    name: 'partnership-volunteers',
    title: 'Partnership Volunteers'
);

$rm->createTemplate('partnership-companies');

$rm->createPage(
    template: 'partnership-companies',
    parent: '/',
    name: 'partnership-companies',
    title: 'Partnership Companies'
);

$rm->createTemplate('partnership-researchers');

$rm->createPage(
    template: 'partnership-researchers',
    parent: '/',
    name: 'partnership-researchers',
    title: 'Partnership Researchers'
);

$rm->createTemplate('partnership-ngo'); 

$rm->createPage(
    template: 'partnership-ngo',
    parent: '/',
    name: 'partnership-ngo',
    title: 'Partnership NGO'
);  



$rm->createTemplate('individual-giving');

$rm->createPage(
    template: 'individual-giving',
    parent: '/donors/',
    name: 'individual-giving',
    title: 'Individual Giving'
);

$rm->createTemplate('donors');

$rm->createPage(
    template: 'donors',
    parent: '/',
    name: 'donors',
    title: 'Donors',
);

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
            ]
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
            ],
        ]
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
   
        ]; 

forEach($accountabilityFields as $field){
    $rm->addFieldToTemplate($field, 'accountability');
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
        'album_card' => [
            'type' => 'FieldtypeRepeater',
            'label' => 'Album Card',
            'fields' => [
                'album_card_image',
                'album_card_title',
                'album_card_text',
            ],
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
    
        
       
    ]

]);

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
$rm->addFieldToTemplate('born_title', 'home');
$rm->addFieldToTemplate('born_orange_title', 'home');
$rm->addFieldToTemplate('born_text', 'home');
$rm->addFieldToTemplate('born_image', 'home');
$rm->addFieldToTemplate('areas_cards', 'home');


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
$rm->addFieldToTemplate('card_number', 'individual-giving');
$rm->addFieldToTemplate('card_number2', 'individual-giving');
$rm->addFieldToTemplate('card_number3', 'individual-giving');
$rm->addFieldToTemplate('card_number4', 'individual-giving');
$rm->addFieldToTemplate('card_title', 'individual-giving');
$rm->addFieldToTemplate('born_title', 'individual-giving');


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



