<?php
namespace ProcessWire;



?>

<div id="content">
    <header>
        <?php include('./_nav.php'); ?>
    </header>

    <section class="volunteers header-central">
        <div class="eyebrow">
            <img src="<?= $config->urls->templates ?>icons/Eyebrow_partnership_volunteers.svg" alt="">
        </div>
        <h1>Volunteers & interns</h1>
        <p>FAITH volunteers are not spectators. Whether you join us in Nepal or contribute remotely, you'll have a
            defined role, a named supervisor, and work that matters — because the women we serve deserve nothing less
            than your best.</p>
    </section>
    <section class="second-section-volunteers">
        <div class="container-left">
            <h3>How we collaborate:</h3>
            <div class="first-line">
                <div class="icon-first-line">
                    <img src="<?= $config->urls->templates ?>icons/triangle.svg" alt="icon">
                </div>
                <div class="list-elem">
                    <p class="body-bold ">In Nepal — Lalitpur office & field districts</p>
                    <p>Programme support, documentation, communications, photography film, research assistance.
                        Minimum commitment: 3 months.
                        We assist with invitation letters for volunteer visas; travel, insurance, and accommodation
                        costs are borne by the volunteer or their institution. You'll receive orientation, a
                        safeguarding briefing, and ongoing supervision.</p>
                </div>
            </div>
            <div class="first-line">
                <div class="icon-first-line">
                    <img src="<?= $config->urls->templates ?>icons/triangle.svg" alt="icon">
                </div>
                <div class="list-elem">
                    <p class="body-bold ">Remote — from anywhere</p>
                    <p>Translation, grant research, graphic design, social media, video editing, data work. Remote
                        volunteers join our team calls and are credited for their work.</p>
                </div>
            </div>
            <div class="first-line">
                <div class="icon-first-line">
                    <img src="<?= $config->urls->templates ?>icons/triangle.svg" alt="icon">
                </div>
                <div class="list-elem">
                    <p class="body-bold ">University internships</p>
                    <p>We host placements from international universities with formal acceptance letters, defined
                        learning objectives, supervision, and end-of-placement evaluation for academic credit. Fields
                        that fit well: public health, social work, development studies, gender studies, communications,
                        film.</p>
                </div>
            </div>
        </div>
        <div class="container-right">
            <h3>What we promise every volunteer:</h3>
            <div class="up">
                <div class="first-line">
                    <img src="<?= $config->urls->templates ?>icons/star.svg" alt="icon">
                    <p>A real role with real responsibility — no manufactured busywork</p>
                </div>
                <div class="first-line">
                    <img src="<?= $config->urls->templates ?>icons/star.svg" alt="icon">
                    <p>A named supervisor and structured onboarding</p>
                </div>
                <div class="first-line">
                    <img src="<?= $config->urls->templates ?>icons/star.svg" alt="icon">
                    <p>Orientation including a safeguarding briefing</p>
                </div>
                <div class="first-line">
                    <img src="<?= $config->urls->templates ?>icons/star.svg" alt="icon">
                    <p>A certificate and reference letter upon completion</p>
                </div>
            </div>
            <h3>What we ask of you:</h3>
            <div class="down">
                <div class="first-line">
                    <img src="<?= $config->urls->templates ?>icons/star.svg" alt="icon">
                    <p>Commitment to our code of conduct and safeguarding policy</p>
                </div>
                <div class="first-line">
                    <img src="<?= $config->urls->templates ?>icons/star.svg" alt="icon">
                    <p>Respect for the leadership of the communities we serve — volunteers support, they do not direct
                    </p>
                </div>
                <div class="first-line">
                    <img src="<?= $config->urls->templates ?>icons/star.svg" alt="icon">
                    <p>For placements in Nepal: a police clearance certificate (standard practice for organizations
                        working with vulnerable populations)</p>
                </div>
            </div>
        </div>
    </section>

    <?php include('./_starttoday.php'); ?>

    <?php include('./_footer.php'); ?>

</div>