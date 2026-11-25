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
    <section class="contact-findus stats" data-nav-color="dark">
        <?php
        $nepalAddr = $page->contact_nepal_address ?: "Chudabikram Street\nKupondole -1\nLalitpur 44600, Nepal";
        $germanyAddr = $page->contact_germany_address ?: "Bornkampsweg 24\nAhrensburg 22926,\nGermany";
        $officePhone = $page->contact_office_phone ?: '+977 01 5412012';
        $officeEmail = $page->contact_office_email ?: 'faithinitiative@gmail.com';
        ?>
            <div class="stats-heading">
                <div class="heading-left">
                    <div class="eyebrow">
                        <img src="<?= $config->urls->templates ?>icons/star.png" alt="icon">
                        <h5 style="text-transform: uppercase;">location</h5>
                    </div>
                    <h2><?= $page->contact_findus_title ?: 'Find us on Map' ?></h2>
                </div>
            </div>
            <div class="findus-inner">
                <div class="map-area">
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d7065.95801099961!2d85.30852979709088!3d27.687043755168673!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x39eb19b4ad7096dd%3A0x29fa3d73b99dcc97!2sKupondole%2C%20Patan%2C%20Zona%20de%20Bagmati%2044600%2C%20Nepal!5e0!3m2!1ses!2sde!4v1789045329645!5m2!1sen!2sde"
                        style="border:0;" allowfullscreen="" loading="lazy"
                        referrerpolicy="strict-origin-when-cross-origin"></iframe>
                </div>
                <div class="contact-icons">

                    <div class="icon-container">
                        <div class="icon-map">
                            <img src="<?= $config->urls->templates ?>/icons/flag-nepal.svg" alt="Nepal flag">
                        </div>
                        <p class="body-bold">Nepal</p>
                        <p><?= nl2br($sanitizer->entities($nepalAddr)) ?></p>

                    </div>
                    <div class="icon-container">
                        <div class="icon-map">
                            <img src="<?= $config->urls->templates ?>/icons/flag-germany.svg" alt="Germany flag">
                        </div>
                        <p class="body-bold">Germany</p>
                        <p><?= nl2br($sanitizer->entities($germanyAddr)) ?></p>
                    </div>


                    <div class="icon-container">
                        <div class="icon-call">
                            <img src="<?= $config->urls->templates ?>/icons/call.svg" alt="icon-call">
                        </div>
                        <p class="body-bold">Call</p>
                        <a href="tel:<?= preg_replace('/[^+0-9]/', '', $officePhone) ?>"><?= $officePhone ?></a>
                    </div>
                    <div class="icon-container">
                        <div class="icon-mail">
                            <img src="<?= $config->urls->templates ?>/icons/mail.svg" alt="icon-mail">

                        </div>
                        <p class="body-bold">Email</p>
                        <a href="mailto:<?= $officeEmail ?>"><?= $officeEmail ?></a>
                    </div>

                </div>
            </div>
    </section>

    <section class="content-contact" data-nav-color="dark">
        <div class="contact-form">

        

    

            <?php
                    /*
                     * Contact form — spam-protected (layered, no third-party services):
                     *  1. honeypot field   2. CSRF token   3. min fill time
                     *  4. per-session + site-wide rate limits   5. strict server-side validation
                     * No auto-reply is sent to the submitter: auto-replies to unverified addresses
                     * were abused as a spam relay (name field carried the spam).
                     * Rejections are logged (reason only, no personal data) to Setup → Logs → contact-spam.
                     */
                    $csrfId = 'contact_form';
                    $formErrors = [];
                    $formValues = ['name' => '', 'phone' => '', 'email' => '', 'subject' => '', 'message' => '', 'group' => ''];
                    $allowedGroups = [];
                    foreach (($page->contact_pills ?? []) as $grp) {
                        $label = trim((string) $grp->pill_label);
                        if ($label !== '') $allowedGroups[] = $label;
                    }
                    $spamLog = function (string $reason) use ($log) { $log->save('contact-spam', $reason); };
                    $hasLink = fn(string $s) => (bool) preg_match('~https?://|www\.|\.(com|net|ru|xyz|top|info|site|online|biz|io|shop|click|link|live|app|store|pro)\b|[<>\[\]]~i', $s);
                    $len = fn(string $s) => mb_strlen($s, 'UTF-8');

                    if ($input->requestMethod('POST')) {
                        $silentDrop = null; // reason: pretend success so bots learn nothing

                        // 1. honeypot — hidden from people, bots fill every field
                        if (trim((string) $input->post('website')) !== '') $silentDrop = 'honeypot';

                        // 2. CSRF — bots posting without loading the page fail here
                        $csrfOk = $session->CSRF->hasValidToken($csrfId);

                        // 3. time trap — people need at least 5 seconds to fill the form
                        $shownAt = (int) $session->getFor('contact', 'shown_at');
                        if (!$silentDrop && $csrfOk && $shownAt && (time() - $shownAt) < 5) $silentDrop = 'too fast';

                        $formValues = [
                            'name'    => $input->post->text('name', ['maxLength' => 500]),
                            'phone'   => $input->post->text('phone', ['maxLength' => 100]),
                            'email'   => $input->post->email('email'),
                            'subject' => $input->post->text('subject', ['maxLength' => 500]),
                            'message' => $input->post->textarea('message', ['maxLength' => 10000]),
                            'group'   => $input->post->text('group'),
                        ];

                        if ($silentDrop) {
                            $spamLog($silentDrop);
                            $session->redirect('./?sent=1');
                        }

                        if (!$csrfOk) {
                            // usually an expired/missing session — tell a real person, keep their text
                            $spamLog('csrf');
                            $formErrors[] = 'Your session expired. Please press Send again.';
                        } else {
                            // 5. validation (also catches the long-name-with-link relay spam)
                            $v = $formValues;
                            if (!in_array($v['group'], $allowedGroups, true)) $formErrors[] = 'Please choose who you are reaching out as.';
                            if ($v['name'] === '' || $len($v['name']) > 60 || $hasLink($v['name'])) $formErrors[] = 'Please enter your name (up to 60 characters, no links).';
                            if (!preg_match('~^\+?[0-9\s\-().]{6,20}$~', $v['phone']) || preg_match_all('~[0-9]~', $v['phone']) < 6) $formErrors[] = 'Please enter a valid phone number.';
                            if ($v['email'] === '') $formErrors[] = 'Please enter a valid email address.';
                            if ($v['subject'] === '' || $len($v['subject']) > 150 || $hasLink($v['subject'])) $formErrors[] = 'Please enter a subject (up to 150 characters, no links).';
                            if ($len(trim($v['message'])) < 2 || $len($v['message']) > 5000) $formErrors[] = 'Please enter a message (up to 5000 characters).';
                            if ($formErrors) $spamLog('invalid: ' . count($formErrors) . ' field(s)');
                        }

                        // 4. rate limits — per session and site-wide (no IPs: the host sits behind a proxy)
                        if (!$formErrors) {
                            $now = time();
                            $recent = fn(array $ts, int $secs) => count(array_filter($ts, fn($t) => $t > $now - $secs));
                            $mine = array_values(array_filter((array) $session->getFor('contact', 'sent_at'), fn($t) => $t > $now - 86400));
                            $all = array_values(array_filter((array) $cache->get('contact_form_sent_at'), fn($t) => $t > $now - 86400));
                            if ($recent($mine, 600) >= 3 || count($mine) >= 10) {
                                $spamLog('rate limit: session');
                                $formErrors[] = 'You have sent several messages already. Please try again later.';
                            } elseif ($recent($all, 3600) >= 20 || count($all) >= 100) {
                                $spamLog('rate limit: site-wide');
                                $formErrors[] = 'We are receiving many messages right now. Please try again later or email us directly.';
                            }
                        }

                        if (!$formErrors) {
                        $name = $formValues['name'];
                        $phone = $formValues['phone'];
                        $email = $formValues['email'];
                        $subject = $formValues['subject'];
                        $message = $formValues['message'];
                        $group = $formValues['group'];

                        $adminEmail = $page->contact_admin_email ?: ($pages->get('/footer/')->contact_admin_email ?: 'faithinitiative@gmail.com');

                        // save submission (browsable under Contact Submissions in admin)
                        try {
                            $parent = $pages->get('/contact-submissions/');
                            if ($parent->id) {
                                $sub = new Page();
                                $sub->template = 'contact_submission';
                                $sub->parent = $parent;
                                $sub->name = 'submission-' . time() . '-' . mt_rand(100, 999);
                                $sub->title = ($name ?: 'Submission') . ($subject ? ' — ' . $subject : '');
                                $sub->contact_name = $name;
                                $sub->contact_email = $email;
                                $sub->contact_phone = $phone;
                                $sub->contact_subject = $subject;
                                $sub->contact_group = $group;
                                $sub->contact_message = $message;
                                $sub->save();
                            }
                        } catch (\Throwable $e) {
                            wire()->log->error('contact submission save failed: ' . $e->getMessage());
                        }

                        // notify admin (best-effort — submission already saved)
                        try {
                            $mail = wireMail();
                            $mail->to($adminEmail);
                            $mail->from($adminEmail);
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
                            $mail->send();
                        } catch (\Throwable $e) {
                            wire()->log->error('contact admin mail failed: ' . $e->getMessage());
                        }

                        // no confirmation mail to the submitter (spam-relay risk) — the on-page dialog confirms

                        $mine[] = $now;
                        $all[] = $now;
                        $session->setFor('contact', 'sent_at', $mine);
                        $cache->save('contact_form_sent_at', $all, 86400);
                        $session->CSRF->resetToken($csrfId);
                        $session->redirect('./?sent=1');
                        }
                    }

                    // remember when the form was shown (time trap)
                    $session->setFor('contact', 'shown_at', time());
                    $fv = fn(string $k) => $sanitizer->entities($formValues[$k]);
            ?>

            <?php if ($input->get->sent): ?>
                <div class="share-dialog success-dialog hidden-story" id="success-dialog">
                    <div class="icon" id="close-success"><img src="<?= $config->urls->templates ?>icons/close-dark.svg"
                            alt=""></div>
                    <div class="success-check">
                        <svg width="56" height="56" viewBox="0 0 56 56" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <circle cx="28" cy="28" r="26" />
                            <path d="M17 29l7.5 7.5L39 22" />
                        </svg>
                    </div>
                    <h4>Thank you</h4>
                    <p>Your message has been received.<br>We will get back to you shortly.</p>
                </div>
            <?php endif; ?>

            <form onsubmit="return validateForm()" method="post" action="./" novalidate>
                <?= $session->CSRF->renderInput($csrfId) ?>
                <div style="position:absolute;left:-10000px;top:auto;width:1px;height:1px;overflow:hidden;" aria-hidden="true">
                    <label for="website">Leave this field empty</label>
                    <input type="text" id="website" name="website" value="" tabindex="-1" autocomplete="off">
                </div>
                <?php if ($formErrors): ?>
                <div class="required" role="alert">
                    <?php foreach ($formErrors as $err): ?>
                    <p class="warning-message" style="display:flex;width:auto;height:auto;"><img src="<?= $config->urls->templates ?>icons/error.svg" alt=""> <?= $sanitizer->entities($err) ?></p>
                    <?php endforeach; ?>
                </div>
                <?php endif; ?>
                <div class="row-form">
                    <div class="pill-group w100 m10">
                        <p class="body-bold">I am reaching out as <span class="req-star">*</span></p>
                        <div class="pill-grid">
                            <?php foreach (($page->contact_pills ?? []) as $grp):
                                $gl = $sanitizer->entities($grp->pill_label);
                                $sel = $formValues['group'] !== '' && $formValues['group'] === trim((string) $grp->pill_label); ?>
                            <label class="pill<?= $sel ? ' active' : '' ?>">
                                <input type="radio" name="group" value="<?= $gl ?>"<?= $sel ? ' checked' : '' ?>>
                                <span><?= $gl ?></span>
                            </label>
                            <?php endforeach; ?>
                        </div>
                        <div class="pill-cards" aria-live="polite">
                            <?php foreach (($page->contact_pills ?? []) as $grp):
                                $gl = $sanitizer->entities($grp->pill_label);
                                $you = array_filter(array_map('trim', explode("\n", (string)$grp->pill_you_bring)));
                                $we = array_filter(array_map('trim', explode("\n", (string)$grp->pill_we_bring)));
                            ?>
                            <div class="pill-card<?= ($formValues['group'] !== '' && $formValues['group'] === trim((string) $grp->pill_label)) ? ' active' : '' ?>" data-group="<?= $gl ?>">
                                <h4><?= $gl ?></h4>
                                <p class="pill-tagline"><?= $sanitizer->entities($grp->pill_tagline) ?></p>
                                <p><?= nl2br($sanitizer->entities($grp->pill_desc)) ?></p>
                                <div class="pill-cols">
                                    <div>
                                        <h5>What you bring</h5>
                                        <ul>
                                            <?php foreach ($you as $li): ?>
                                            <li><?= $sanitizer->entities($li) ?></li>
                                            <?php endforeach; ?>
                                        </ul>
                                    </div>
                                    <div>
                                        <h5>What we bring</h5>
                                        <ul>
                                            <?php foreach ($we as $li): ?>
                                            <li><?= $sanitizer->entities($li) ?></li>
                                            <?php endforeach; ?>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
                <div class="row-form">
                    <div class="name-form w50 m10">
                        <label for="name">
                            <p class="body-bold">Name <span class="req-star">*</span></p>
                        </label>
                        <input id="name" type="text" title="your name" name="name" placeholder="Your name" maxlength="60" value="<?= $fv('name') ?>" required>
                    </div> <!-- name form -->
                    <div class="phone-form w50 m10">
                        <label for="phone">
                            <p class="body-bold">Phone number <span class="req-star">*</span></p>

                        </label>
                        <input title="phone number" type="tel" id="phone" name="phone" placeholder="+000..." maxlength="20" value="<?= $fv('phone') ?>" required>
                    </div> <!-- phone form -->
                </div>
                <div class="row-form">
                    <div class="mail-form w50 m10">
                        <label for="email">
                            <p class="body-bold">Email <span class="req-star">*</span></p>
                        </label>
                        <input title="email address" type="email" id="email" name="email" placeholder="Email address"
                            maxlength="254" value="<?= $fv('email') ?>" required>
                    </div><!-- mail form --->
                    <div class="subject-form w50 m10">
                        <label for="subject">
                            <p class="body-bold">Subject <span class="req-star">*</span></p>
                        </label>
                        <input type="text" title="subject" id="subject" name="subject"
                            placeholder="What would you like to talk about?" maxlength="150" value="<?= $fv('subject') ?>" required>
                    </div> <!-- subject form -->
                </div>
                <div class="row-form">
                    <div class="message-form w100 m10">
                        <label for="message">
                            <p class="body-bold">Message <span class="req-star">*</span></p>
                        </label>
                        <textarea class="w100" title="your message" id="message" name="message"
                            placeholder="Tell us more about your enquiry" maxlength="5000" required><?= $fv('message') ?></textarea>
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