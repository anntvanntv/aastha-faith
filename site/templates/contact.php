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
                    <img src="<?= $config->urls->templates ?>/icons/map.png" alt="icon-map">
                </div>
                <p class="body-bold">Nepal</p>
                <p>Chudabikram Street <br>
                    Kupondole -1 <br>
                    Lalitpur 44600, Nepal
                </p>

            </div>
            <div class="icon-container">
                <div class="icon-map">
                    <img src="<?= $config->urls->templates ?>/icons/map.png" alt="icon-map">
                </div>
                <p class="body-bold">Germany</p>
                <p>Bornkampsweg 24 <br>
                    Ahrensburg 22926, <br>
                    Germany
                </p>
            </div>


            <div class="icon-container">
                <div class="icon-call">
                    <img src="<?= $config->urls->templates ?>/icons/call.png" alt="icon-call">
                </div>
                <p class="body-bold">Call</p>
                <a href="tel:+977 01 5412012">+(977) 01 5412012</a>
            </div>
            <div class="icon-container">
                <div class="icon-mail">
                    <img src="<?= $config->urls->templates ?>/icons/mail.png" alt="icon-mail">

                </div>
                <p class="body-bold">Mail</p>
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

                        $mail = wireMail();

                        $mail->to('productoimperio@gmail.com');
                        $mail->from('productoimperio@gmail.com');
                        $mail->replyTo($email);
                        $mail->subject($subject);

                        $mail->body(
                            "Name: $name
                            
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
                    <div class="name-form w50 m10">
                        <label for="name">
                            <div class="icon-error">
                                <img src="<?= $config->urls->templates ?>/icons/error.png" alt="icon">
                            </div>
                            <p class="body-bold">Name</p>
                        </label>
                        <input id="name" type="text" title="your name" name="name" placeholder="Your name" required>
                    </div> <!-- name form -->
                    <div class="phone-form w50 m10">
                        <label for="phone">
                            <p class="body-bold">Phone number</p>

                        </label>
                        <input title="phone number" type="tel" id="phone" name="phone" placeholder="+000...">
                    </div> <!-- phone form -->
                </div>
                <div class="row-form">
                    <div class="mail-form w50 m10">
                        <label for="email">
                            <div class="icon-error">
                                <img src="<?= $config->urls->templates ?>/icons/error.png" alt="icon">
                            </div>
                            <p class="body-bold">E-mail</p>
                        </label>
                        <input title="e-mail address" type="email" id="email" name="email" placeholder="E-mail address"
                            required>
                    </div><!-- mail form --->
                    <div class="subject-form w50 m10">
                        <label for="subject">
                            <p class="body-bold">Subject</p>
                        </label>
                        <input type="text" title="subject" id="subject" name="subject"
                            placeholder="What do you want to talk about">
                    </div> <!-- subject form -->
                </div>
                <div class="row-form">
                    <div class="message-form w100 m10">
                        <label for="message">
                            <div class="icon-error">
                                <img src="<?= $config->urls->templates ?>icons/error.png" alt="icon">
                            </div>
                            <p class="body-bold">Message</p>
                        </label>
                        <textarea class="w100" title="your message" id="message" name="message"
                            placeholder="Tell us more about your enquiry" required></textarea>
                    </div> <!-- message form --->
                </div>
                <div class="row-form">
                    <div class="required">
                        <p>* Required fields</p>
                        <p id="warning-message" class="warning-message"><img src="<?= $config->urls->templates ?>icons/error.svg" alt=""> Please enter all required fields</p>
                        <button class="btn orange" type="submit">Send</button>
                    </div>
                </div>
            </form>
        </div>
    </section>

    <?php include('./_footer.php'); ?>


</div>