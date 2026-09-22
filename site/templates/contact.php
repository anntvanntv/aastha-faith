<?php
namespace ProcessWire;




?>

<div id="content">

    <header>
        <?php include('./_nav.php'); ?>

        <section>
            <div class="header-central">
                <div class="eyebrow">
                    <img src="<?= $config->urls->templates ?>icons/trinagle-dark.png" alt="icon">
                    <h5 style="text-transform: uppercase;">say hi</h5>
                </div>
                <h2>Get in <span class="orange-text">touch</span></h2>


                <p>Partner with us. Support our work. Join the movement for women's rights and health justice in Nepal.
                </p>
                <!-- <a class="btn transparent" href="/contact">
                    Book a call
                    <img src="<?= $config->urls->templates ?>/icons/arrow_forward_orange.png" alt="">
                </a> -->
            </div>


        </section>
    </header>
    <section class="content-contact" data-nav-color="dark">
        <div class="contact-icons">

            <div class="icon-container">
                <div class="icon-map">
                    <img src="<?= $config->urls->templates ?>/icons/flag-nepal.svg" alt="Nepal flag">
                </div>
                <p class="body-bold">Nepal</p>
                <p>Chudabikram Street <br>
                    Kupondole -1 <br>
                    Lalitpur 44600, Nepal
                </p>

            </div>
            <div class="icon-container">
                <div class="icon-map">
                    <img src="<?= $config->urls->templates ?>/icons/flag-germany.svg" alt="Germany flag">
                </div>
                <p class="body-bold">Germany</p>
                <p>Bornkampsweg 24 <br>
                    Ahrensburg 22926, <br>
                    Germany
                </p>
            </div>


            <div class="icon-container">
                <div class="icon-call">
                    <img src="<?= $config->urls->templates ?>/icons/call.svg" alt="icon-call">
                </div>
                <p class="body-bold">Call</p>
                <a href="tel:+977 01 5412012">+977 01 5412012</a>
            </div>
            <div class="icon-container">
                <div class="icon-mail">
                    <img src="<?= $config->urls->templates ?>/icons/mail.svg" alt="icon-mail">

                </div>
                <p class="body-bold">Email</p>
                <a href="mailto:faithinitiative@gmail.com">faithinitiative<wbr>@gmail.com</a>
            </div>

        </div>
        <div class="divider">
            <img src="<?= $config->urls->templates ?>icons/Divider.png" alt="icon">
        </div>

        
        <div class="contact-form">

        

    

            <?php
                    if($input->post->name) {

                        $name = $input->post->text('name');
                        $phone = $input->post->text('phone');
                        $email = $input->post->email('email');
                        $subject = $input->post->text('subject');
                        $message = $input->post->textarea('message');
                        $group = $input->post->text('group');

                        $mail = wireMail();

                        $mail->to('productoimperio@gmail.com');
                        $mail->from('productoimperio@gmail.com');
                        $mail->replyTo($email);
                        $mail->subject($subject);

                        $mail->body(
                            "Name: $name
                            
                            Group: $group
                            
                            Phone: $phone
                            
                            Email: $email
                            
                            Message:
                            
                            $message"
                            );

                            if($mail->send()) {
                                $session->redirect('./?sent=1');
                               
                            } 

                    }
            ?>

            <form onsubmit="return validateForm()" method="post" action="./" novalidate>
                <div class="row-form">
                    <div class="pill-group w100 m10">
                        <p class="body-bold">I am reaching out as <span class="req-star">*</span></p>
                        <div class="pill-grid">
                            <label class="pill">
                                <input type="radio" name="group" value="NGOs &amp; CBOs">
                                <span>NGOs &amp; CBOs</span>
                            </label>
                            <label class="pill">
                                <input type="radio" name="group" value="Volunteers &amp; Interns">
                                <span>Volunteers &amp; Interns</span>
                            </label>
                            <label class="pill">
                                <input type="radio" name="group" value="Private Sector">
                                <span>Private Sector</span>
                            </label>
                            <label class="pill">
                                <input type="radio" name="group" value="Researchers">
                                <span>Researchers</span>
                            </label>
                        </div>
                        <div class="pill-cards" aria-live="polite">
                            <div class="pill-card" data-group="NGOs &amp; CBOs">
                                <h4>NGOs &amp; CBOs</h4>
                                <p class="pill-tagline">Partners, not sub-grantees</p>
                                <p>We work with community organisations in Nepal and NGOs across the region on joint proposals, shared advocacy, and bringing our peer model to new districts. You know your community; we bring the funding, safeguarding, and reporting experience most calls demand.</p>
                                <div class="pill-cols">
                                    <div>
                                        <h5>What you bring</h5>
                                        <ul>
                                            <li>A community you are accountable to</li>
                                            <li>Registration and accounts, or the will to build them</li>
                                            <li>A concrete idea: a call, a district, a policy goal</li>
                                        </ul>
                                    </div>
                                    <div>
                                        <h5>What we bring</h5>
                                        <ul>
                                            <li>21 years of beneficiary-led programming</li>
                                            <li>A documented, proven peer-to-peer model</li>
                                            <li>Links into global mental health networks</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="pill-card" data-group="Volunteers &amp; Interns">
                                <h4>Volunteers &amp; Interns</h4>
                                <p class="pill-tagline">Eight weeks minimum</p>
                                <p>Most roles are remote: grant research, translation, data, film and photo editing, web and social media. Some placements are in Lalitpur. We don't offer short visits to our communities — volunteers support the organisation; peers support the community.</p>
                                <div class="pill-cols">
                                    <div>
                                        <h5>What you bring</h5>
                                        <ul>
                                            <li>Eight weeks or more, at agreed weekly hours</li>
                                            <li>A specific skill, and working English</li>
                                            <li>A police check and a signed safeguarding policy</li>
                                        </ul>
                                    </div>
                                    <div>
                                        <h5>What we bring</h5>
                                        <ul>
                                            <li>A named supervisor and a written role</li>
                                            <li>Induction on safeguarding and confidentiality</li>
                                            <li>A reference and certificate for your work</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="pill-card" data-group="Private Sector">
                                <h4>Private Sector</h4>
                                <p class="pill-tagline">Flexible funding goes furthest</p>
                                <p>Unrestricted, multi-year support pays for what grants don't: peer educators' transport, a counsellor between grant cycles, an audit. Skills help too when they fill a gap — legal, accounting, IT, logistics.</p>
                                <div class="pill-cols">
                                    <div>
                                        <h5>What you bring</h5>
                                        <ul>
                                            <li>Unrestricted, matched, or multi-year giving</li>
                                            <li>Pro bono skills with real hours behind them</li>
                                            <li>Respect for our communities' privacy in any publicity</li>
                                        </ul>
                                    </div>
                                    <div>
                                        <h5>What we bring</h5>
                                        <ul>
                                            <li>Audited accounts and clear reporting</li>
                                            <li>Consent-cleared stories and images</li>
                                            <li>Staff talks on gender, HIV, and mental health</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="pill-card" data-group="Researchers">
                                <h4>Researchers</h4>
                                <p class="pill-tagline">Designed with us, not about us</p>
                                <p>We co-design research on women's and maternal mental health, HIV, harm reduction, stigma, and climate stress. Come early enough for us to shape the questions. Participants are paid for their time, community researchers are named as authors, and findings return to the community in Nepali.</p>
                                <div class="pill-cols">
                                    <div>
                                        <h5>What you bring</h5>
                                        <ul>
                                            <li>Ethics approval, including NHRC clearance</li>
                                            <li>Budget for participants and community researchers</li>
                                            <li>Agreement on authorship and data ownership</li>
                                        </ul>
                                    </div>
                                    <div>
                                        <h5>What we bring</h5>
                                        <ul>
                                            <li>Two decades of trust with hard-to-reach groups</li>
                                            <li>Trained peer researchers and safe settings</li>
                                            <li>Honest review of your tools before fieldwork</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row-form">
                    <div class="name-form w50 m10">
                        <label for="name">
                            <p class="body-bold">Name <span class="req-star">*</span></p>
                        </label>
                        <input id="name" type="text" title="your name" name="name" placeholder="Your name" required>
                    </div> <!-- name form -->
                    <div class="phone-form w50 m10">
                        <label for="phone">
                            <p class="body-bold">Phone number <span class="req-star">*</span></p>

                        </label>
                        <input title="phone number" type="tel" id="phone" name="phone" placeholder="+000..." required>
                    </div> <!-- phone form -->
                </div>
                <div class="row-form">
                    <div class="mail-form w50 m10">
                        <label for="email">
                            <p class="body-bold">Email <span class="req-star">*</span></p>
                        </label>
                        <input title="email address" type="email" id="email" name="email" placeholder="Email address"
                            required>
                    </div><!-- mail form --->
                    <div class="subject-form w50 m10">
                        <label for="subject">
                            <p class="body-bold">Subject <span class="req-star">*</span></p>
                        </label>
                        <input type="text" title="subject" id="subject" name="subject"
                            placeholder="What would you like to talk about?" required>
                    </div> <!-- subject form -->
                </div>
                <div class="row-form">
                    <div class="message-form w100 m10">
                        <label for="message">
                            <p class="body-bold">Message <span class="req-star">*</span></p>
                        </label>
                        <textarea class="w100" title="your message" id="message" name="message"
                            placeholder="Tell us more about your enquiry" required></textarea>
                    </div> <!-- message form --->
                </div>
                <div class="row-form">
                    <div class="required">
                        <p><span class="req-star">*</span> Required fields</p>
                        <p id="warning-message" class="warning-message"><img src="<?= $config->urls->templates ?>icons/error.svg" alt=""> Please enter all required fields</p>
                        <button class="btn orange" type="submit">Send</button>
                    </div>
                </div>
            </form>
        </div>
    </section>

    <?php include('./_footer.php'); ?>


</div>