<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/dist/css/takePhoto.css">
<div class="content-wrapper">
       <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="col-md-6">
                    <div class="box box-primary">
                        <div class="box-header">
                            <h3 class="box-title">Upload image</h3>
                        </div>
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <?php if (isset($error)) {
                                        echo '<div class="callout callout-danger">
                                        <h4>Error!</h4>
                                        ' . $error . '
                                </div>';
                                    }
                                    ?>
                                    <?php echo form_open_multipart('Emotion_recognition/recognition'); ?>
                                    <input type="file" name="userfile" size="20"/>
                                    <br/>
                                    <input class="btn btn-primary" type="submit" value="Upload"/>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="box box-primary">
                        <div class="box-header">
                            <h3 class="box-title">Take photo with Webcam</h3>
                        </div>
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <br>
                                    <br>
                                    <a href="<?php echo base_url();?>Emotion_recognition/selfie" type="button" class="btn btn-primary">Seflie</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
                <div class="col-md-12">
                <div class="container">
                    <div class="app">
                        <a href="#" id="start-camera" class="visible">Touch here to start the app.</a>
                        <video id="camera-stream"></video>
                        <img id="snap">

                        <p id="error-message"></p>

                        <div class="controls">
                            <a href="#" id="delete-photo" title="Delete Photo" class="disabled"><i
                                        class="material-icons">delete</i></a>
                            <a href="#" id="take-photo" title="Take Photo"><i class="material-icons">camera_alt</i></a>
                            <a href="#" id="download-photo" download="selfie.png" title="Save Photo" class="disabled"><i
                                        class="material-icons">file_download</i></a>
                        </div>
                        <canvas></canvas>

                    </div>

                </div>
            </div>
        </div>
    </section>
</div>
<script src="<?php echo base_url(); ?>assets/js/takePhoto.js"></script>
