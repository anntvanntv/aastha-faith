<?php

session_write_close();
$session->redirect($pages->get('/media/photo-gallery/')->url);