<?php
namespace ProcessWire;




?>

<div id="content">
    <header>
        <?php include('./_nav.php'); ?>

        <section class="about-header-content">
            <div class="title-section-about">
                <div class="eyebrow">
                    <img src="<?= $config->urls->templates ?>icons/star.png" alt="icon">
                    <h5 style="text-transform: uppercase;">how it started</h5>
                </div>
                <h1 edit="hero_title1"><?= $page->hero_title1 ?: 'Built by women.' ?> <span edit="born_orange_title" class="orange-text"><?= $page->born_orange_title ?: 'Led by community.' ?></span></h1>

            </div>
            <div class="description-about">
                <div edit="born_image,image_description" class="foto">
                    <img  src="<?= $page->born_image->url ?>" 
                    alt="<?= htmlspecialchars($page->image_description) ?>">
                </div>
                <div class="text">
                    <p edit="hero_description" class="text1"><?= $page->hero_description ?></p>
                    <p edit="hero_description2" class="text2"><?= $page->hero_description2 ?></p>
                </div>
            </div>
        </section>
    </header>
    <section class="peer" data-nav-color="light">
        <div class="heading-peer">
            <div class="title-peer">
                <div class="eyebrow">
                    <img src="<?= $config->urls->templates ?>icons/star.png" alt="icon">
                    <h5>WHERE IT BEGAN</h5>
                </div>

                <h2 edit="hero_title2"><?= $page->hero_title2 ?></h2>
                <p edit="description_about"><?= $page->description_about ?>
                </p>

            </div>
        </div>
        <div edit='quote_image,image_description2' class="picture-peer">
            <img src="<?= $page->quote_image->url ?>" 
            alt="<?= htmlspecialchars($page->image_description2) ?>">
        </div>
    </section>
    <section class="theory" data-nav-color="dark">
        <div class="header-theory">
            <div class="eyebrow">
                <img src="<?= $config->urls->templates ?>icons/star.png" alt="icon">
                <h5 style="text-transform: uppercase;">how we work</h5>
            </div>
            <h2 edit="hero_title3"><?= $page->hero_title3 ?></h2>
            <p edit="description_again"><?= $page->description_again ?></p>
        </div>
        <div edit="image,image_description3" class="picture-theory">
            <img src="<?= $page->image->url ?>"
             alt="<?= htmlspecialchars($page->image_description3) ?>">

        </div>
    </section>
    <section class="years" data-nav-color="light">
        <div class="heading">
            <div class="eyebrow">
                <img src="<?= $config->urls->templates ?>icons/star.png" alt="icon">
                <h5 style="text-transform: uppercase;">through the years</h5>
            </div>
            <div class="title">

                <h2 edit="title_content"><?= $page->title_content ?></h2>
                <p edit="text_pivotal"><?= $page->text_pivotal ?></p>

            </div>
        </div>
        <div class="years-content">
            <div class="description">
                <h4>"We did not form an organisation. We formed a community. The organisation came later — because the
                    community needed one."</h4>
                <p>— Reena Lama, Executive Director, AASTHA FAITH</p>
            </div>

            <div class="timeline">
                <div class="tl">
                    <div class="tl-left orange-text">
                        <h5>2005</h5>
                    </div>
                    <div class="line_vertical">
                        <img src="<?= $config->urls->templates ?>icons/line_vertical.png" alt="line_vertical">
                    </div>
                    <div class="tl-right">
                        <p>FAITH founded in Lalitpur by women affected by Nepal's HIV/AIDS crisis, creating a space for
                            solidarity, advocacy, and dignity.</p>
                    </div>
                </div>
                <div class="tl">
                    <div class="tl-left orange-text">
                        <h5>2006</h5>
                    </div>
                    <div class="line_vertical">
                        <img src="<?= $config->urls->templates ?>icons/line_vertical.png" alt="line_vertical">
                    </div>
                    <div class="tl-right">
                        <p>First structured peer support groups established for women living with HIV in Kathmandu
                            Valley.
                        </p>
                    </div>
                </div>
                <div class="tl 2007">
                    <div class="tl-left orange-text">
                        <h5>2007</h5>
                    </div>
                    <div class="line_vertical">
                        <img src="<?= $config->urls->templates ?>icons/line_vertical.png" alt="line_vertical">
                    </div>
                    <div class="tl-right">
                        <p>Pioneered TB screening and treatment protocols for HIV-positive women, later adopted as a
                            national standard.</p>
                    </div>
                </div>
                <div class="tl 2008">
                    <div class="tl-left orange-text">
                        <h5>2008</h5>
                    </div>
                    <div class="line_vertical">
                        <img src="<?= $config->urls->templates ?>icons/line_vertical.png" alt="line_vertical">
                    </div>
                    <div class="tl-right">
                        <p>Expanded outreach to female drug users and female sex workers; established the first Drop-In
                            Centre.</p>
                    </div>
                </div>
                <div class="tl">
                    <div class="tl-left orange-text">
                        <h5>2009</h5>
                    </div>
                    <div class="line_vertical">
                        <img src="<?= $config->urls->templates ?>icons/line_vertical.png" alt="line_vertical">
                    </div>
                    <div class="tl-right">
                        <p>Published formative research on behaviour change communication with FPAN/Global Fund and
                            developed TB-HIV mass media IEC guidelines.</p>
                    </div>
                </div>
                <div class="tl">
                    <div class="tl-left orange-text">
                        <h5>2010</h5>
                    </div>
                    <div class="line_vertical">
                        <img src="<?= $config->urls->templates ?>icons/line_vertical.png" alt="line_vertical">
                    </div>
                    <div class="tl-right">
                        <p>Launched advocacy campaigns to reduce stigma in healthcare settings for PLHIV and FSWs.</p>
                    </div>
                </div>
                <div class="tl">
                    <div class="tl-left orange-text">
                        <h5>2011</h5>
                    </div>
                    <div class="line_vertical">
                        <img src="<?= $config->urls->templates ?>icons/line_vertical.png" alt="line_vertical">
                    </div>
                    <div class="tl-right">
                        <p>Expanded harm reduction programme, reaching 568 people who inject drugs through outreach.</p>
                    </div>
                </div>
                <div class="tl">
                    <div class="tl-left orange-text">
                        <h5>2012</h5>
                    </div>
                    <div class="line_vertical">
                        <img src="<?= $config->urls->templates ?>icons/line_vertical.png" alt="line_vertical">
                    </div>
                    <div class="tl-right">
                        <p>Completed national baseline assessment of injection safety across 78 hospitals, supported by
                            WHO/HQ Geneva.</p>
                    </div>
                </div>
                <div class="tl">
                    <div class="tl-left orange-text">
                        <h5>2013</h5>
                    </div>
                    <div class="line_vertical">
                        <img src="<?= $config->urls->templates ?>icons/line_vertical.png" alt="line_vertical">
                    </div>
                    <div class="tl-right">
                        <p>Strengthened network of community-based organisations across 10 districts.</p>
                    </div>
                </div>
                <div class="tl">
                    <div class="tl-left orange-text">
                        <h5>2014</h5>
                    </div>
                    <div class="line_vertical">
                        <img src="<?= $config->urls->templates ?>icons/line_vertical.png" alt="line_vertical">
                    </div>
                    <div class="tl-right">
                        <p>Launched SRHR advocacy programme targeting women living with HIV and female sex workers.</p>
                    </div>
                </div>
                <div class="tl">
                    <div class="tl-left orange-text">
                        <h5>2015</h5>
                    </div>
                    <div class="line_vertical">
                        <img src="<?= $config->urls->templates ?>icons/line_vertical.png" alt="line_vertical">
                    </div>
                    <div class="tl-right">
                        <p>Formally declared as a women-led organisation, with all decision-making positions designated
                            for women.</p>
                    </div>
                </div>
                <div class="tl">
                    <div class="tl-left orange-text">
                        <h5>2016</h5>
                    </div>
                    <div class="line_vertical">
                        <img src="<?= $config->urls->templates ?>icons/line_vertical.png" alt="line_vertical">
                    </div>
                    <div class="tl-right">
                        <p>Launched a five-year SRHR orientation programme, reaching 6,912 girls and women across 17
                            districts.</p>
                    </div>
                </div>
                <div class="tl">
                    <div class="tl-left orange-text">
                        <h5>2017</h5>
                    </div>
                    <div class="line_vertical">
                        <img src="<?= $config->urls->templates ?>icons/line_vertical.png" alt="line_vertical">
                    </div>
                    <div class="tl-right">
                        <p>Trained 1,113 local government healthcare providers on SRHR rights across 16 districts.</p>
                    </div>
                </div>
                <div class="tl">
                    <div class="tl-left orange-text">
                        <h5>2018</h5>
                    </div>
                    <div class="line_vertical">
                        <img src="<?= $config->urls->templates ?>icons/line_vertical.png" alt="line_vertical">
                    </div>
                    <div class="tl-right">
                        <p>Assessed and addressed stigma in healthcare settings, training 205 health providers to
                            deliver SRH services without discrimination.</p>
                    </div>
                </div>
                <div class="tl">
                    <div class="tl-left orange-text">
                        <h5>2019</h5>
                    </div>
                    <div class="line_vertical">
                        <img src="<?= $config->urls->templates ?>icons/line_vertical.png" alt="line_vertical">
                    </div>
                    <div class="tl-right">
                        <p>Developed the Safetypin mobile application to improve access to safe abortion information for
                            marginalised women.</p>
                    </div>
                </div>
                <div class="tl">
                    <div class="tl-left orange-text">
                        <h5>2020</h5>
                    </div>
                    <div class="line_vertical">
                        <img src="<?= $config->urls->templates ?>icons/line_vertical.png" alt="line_vertical">
                    </div>
                    <div class="tl-right">
                        <p>Maintained programme continuity through the early COVID-19 period and adapted outreach to
                            community needs.</p>
                    </div>
                </div>
                <div class="tl">
                    <div class="tl-left orange-text">
                        <h5>2021</h5>
                    </div>
                    <div class="line_vertical">
                        <img src="<?= $config->urls->templates ?>icons/line_vertical.png" alt="line_vertical">
                    </div>
                    <div class="tl-right">
                        <p>Provided COVID-19 relief packages to 280 women across 15 districts while continuing SRHR and
                            legal advocacy.</p>
                    </div>
                </div>
                <div class="tl">
                    <div class="tl-left orange-text">
                        <h5>2022</h5>
                    </div>
                    <div class="line_vertical">
                        <img src="<?= $config->urls->templates ?>icons/line_vertical.png" alt="line_vertical">
                    </div>
                    <div class="tl-right">
                        <p>Established a bakery training facility for female sex workers with FREE Fund and launched
                            Phase I economic empowerment programme.</p>
                    </div>
                </div>
                <div class="tl">
                    <div class="tl-left orange-text">
                        <h5>2023</h5>
                    </div>
                    <div class="line_vertical">
                        <img src="<?= $config->urls->templates ?>icons/line_vertical.png" alt="line_vertical">
                    </div>
                    <div class="tl-right">
                        <p>Launched peer mental health model for women in the entertainment sector, reaching 1,007
                            marginalised women in Lalitpur.</p>
                    </div>
                </div>
                <div class="tl">
                    <div class="tl-left orange-text">
                        <h5>2024</h5>
                    </div>
                    <div class="line_vertical">
                        <img src="<?= $config->urls->templates ?>icons/line_vertical.png" alt="line_vertical">
                    </div>
                    <div class="tl-right">
                        <p>595 women completed financial literacy across 7 districts; 51 youth enrolled in STEM; 1,732
                            women reached with legal literacy.</p>
                    </div>
                </div>
                <div class="tl">
                    <div class="tl-left orange-text">
                        <h5>2025</h5>
                    </div>
                    <div class="line_vertical">
                        <img src="<?= $config->urls->templates ?>icons/line_vertical.png" alt="line_vertical">
                    </div>
                    <div class="tl-right">
                        <p>FAITH celebrates 20 years: a national network, a proven model, and eight focus areas for the
                            next chapter.</p>
                    </div>
                </div>

            </div><!--  end timeline    -->
        </div> <!-- end content  -->
    </section>
    <section class="city" data-nav-color="light">
        <div edit="hero_image,image_description4" class="photo-city">
            <img src="<?= $page->hero_image->url ?>" 
            alt="<?= htmlspecialchars($page->image_description4) ?>">
        </div>
    </section>
    <section class="team">
        <div class="team-title">
            <h2 edit="title_change"><?= $page->title_change ?></h2>
        </div>
        <div class="team-members">
            <?php foreach ($page->about_card as $card): ?>
                <div edit='about_card' class="member" role="button" tabindex="0" aria-pressed="false" aria-label="Flip card for <?= $card->about_card_name ?>">
                    <div class="member-inner">
                        <div class="member-front">
                            <div edit='<?= $card ?>.image_about_card' class="avatar">
                                <img src="<?= $card->image_about_card->url ?>" alt="">
                            </div>
                            <div class="name">
                                <h3 edit="<?= $card ?>.about_card_name "><?= $card->about_card_name ?></h3>
                                <p edit="<?= $card ?>.about_card_job" class="small"><?= $card->about_card_job ?></p>
                            </div>
                        </div>
                        <div class="member-back">
                            <div class="avatar">
                                <img src="<?= $card->about_card_ghibli ? $card->about_card_ghibli->url : $card->image_about_card->url ?>" alt="">
                            </div>
                            <div class="name">
                                <h3><?= $card->about_card_name ?></h3>
                                <p class="small"><?= $card->about_card_function ?></p>
                                <?php if($card->about_card_back): ?>
                                    <p><?= $card->about_card_back ?></p>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
           <!--  <div class="member">

                <div class="avatar">
                    <img src="<?= $config->urls->templates ?>images/about/avatar.jpg" alt="picture">
                </div>
                <div class="name">
                    <h3>Name</h3>
                    <p class="small">Job</p>
                    <p>Brief information about the role and the person</p>
                </div>
            </div>

            <div class="member" data-nav-color="dark">
                <div class="avatar">
                    <img src="<?= $config->urls->templates ?>images/about/avatar.jpg" alt="picture">
                </div>
                <div class="name">
                    <h3>Name</h3>
                    <p class="small">Job</p>
                    <p>Brief information about the role and the person</p>
                </div>
            </div>
            <div class="member">
                <div class="avatar">
                    <img src="<?= $config->urls->templates ?>images/about/avatar.jpg" alt="picture">
                </div>
                <div class="name">
                    <h3>Name</h3>
                    <p class="small">Job</p>
                    <p>Brief information about the role and the person</p>
                </div>
            </div>
            <div class="member">
                <div class="avatar">
                    <img src="<?= $config->urls->templates ?>images/about/avatar.jpg" alt="picture">
                </div>
                <div class="name">
                    <h3>Name</h3>
                    <p class="small">Job</p>
                    <p>Brief information about the role and the person</p>
                </div>
            </div>
            <div class="member">
                <div class="avatar">
                    <img src="<?= $config->urls->templates ?>images/about/avatar.jpg" alt="picture">
                </div>
                <div class="name">
                    <h3>Name</h3>
                    <p class="small">Job</p>
                    <p>Brief information about the role and the person</p>
                </div>
            </div>
            <div class="member">
                <div class="avatar">
                    <img src="<?= $config->urls->templates ?>images/about/avatar.jpg" alt="picture">
                </div>
                <div class="name">
                    <h3>Name</h3>
                    <p class="small">Job</p>
                    <p>Brief information about the role and the person</p>
                </div>
            </div> -->
        </div>
    </section>

    <?php include('./_footer.php'); ?>

</div>