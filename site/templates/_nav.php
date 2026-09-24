<?php
namespace ProcessWire;



?>

<nav>
    <div class="logo">
        <img src="<?= $config->urls->templates ?>assets/logo.png" alt="Logo">
    </div>

    <ul>
        <li>
            <a class="<?= $page->name === 'home' ? 'active' : '' ?>"
               href="<?= $pages->get('/')->url ?>">
                Home
            </a>
        </li>

        <li>
            <a class="<?= $page->name === 'our-work' || $page->parent->name === 'our-work' ? 'active' : '' ?>"
               href="<?= $pages->get('/our-work/')->url ?>">
                Our Work
            </a>
        </li>

        <!-- PARTNERSHIP DROPDOWN -->
       <!--  <li class="partnership-dropdown">
        <a><span class="partnership-title <?= str_starts_with($page->name, 'partnership-') ? 'active' : '' ?>">
            Partnership

                <svg class="partnership-arrow" width="8" height="8" viewBox="0 0 12 8">
                    <path d="M1 1L6 6L11 1"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="2"/>
                </svg>
            </span>
        </a>

            <ul class="partnership-dropdown-menu">
                <li>
                    <a href="<?= $pages->get('/partnership-ngo/')->url ?>">
                        NGOs
                    </a>
                </li>
                <li>
                    <a href="<?= $pages->get('/partnership-researchers/')->url ?>">
                        Researchers
                    </a>
                </li>
                <li>
                    <a href="<?= $pages->get('/partnership-companies/')->url ?>">
                        Companies
                    </a>
                </li>
                <li>
                    <a href="<?= $pages->get('/partnership-volunteers/')->url ?>">
                        Volunteers
                    </a>
                </li>
            </ul>
        </li> -->

        <li>
            <a class="<?= $page->name === 'impact' ? 'active' : '' ?>"
               href="<?= $pages->get('/impact/')->url ?>">
                Impact
            </a>
        </li>

        <li>
            <a class="<?= $page->name === 'stories' || $page->parent->name === 'stories' ? 'active' : '' ?>"
               href="<?= $pages->get('/stories/')->url ?>">
                Stories
            </a>
        </li>

        <?php /* News nav item hidden — news lives inside detail pages
        <li>
            <a class="<?= $page->name === 'news' || $page->parent->name === 'news' ? 'active' : '' ?>"
               href="<?= $pages->get('/news/')->url ?>">
                News
            </a>
        </li>
        */ ?>

        <li>
            <a class="<?= $page->name === 'accountability' ? 'active' : '' ?>"
               href="<?= $pages->get('/accountability/')->url ?>">
                Accountability
            </a>
        </li>

        <li>
            <a class="<?= $page->name === 'about-us' ? 'active' : '' ?>"
               href="<?= $pages->get('/about-us/')->url ?>">
                About Us
            </a>
        </li>

        <li>
            <a class="<?= $page->name === 'contact' ? 'active' : '' ?>"
               href="<?= $pages->get('/contact/')->url ?>">
                Contact Us
            </a>
        </li>
    </ul>

    <div class="d-flex">
        <div class="menu" onclick="myMenu()">

            <svg id="menu-icon" class="icon" width="18" height="12"
                 viewBox="0 0 18 12" fill="none"
                 xmlns="http://www.w3.org/2000/svg">
                <path d="M0 12H18V10H0V12ZM0 7H18V5H0V7ZM0 0V2H18V0H0Z" />
            </svg>

            <svg id="close-icon" class="icon hidden" width="14" height="14"
                 viewBox="0 0 14 14" fill="none"
                 xmlns="http://www.w3.org/2000/svg">
                <path d="M14 1.41L12.59 0L7 5.59L1.41 0L0 1.41L5.59 7L0 12.59L1.41 14L7 8.41L12.59 14L14 12.59L8.41 7L14 1.41Z" />
            </svg>

        </div>

        <a class="btn orange herobtn" href="<?= $pages->get('/donors/')->url ?>">
            GIVEFULLY
            <img src="<?= $config->urls->templates ?>icons/arrow_forward_white.png" alt="icon-arrow">
        </a>
    </div>
</nav>
