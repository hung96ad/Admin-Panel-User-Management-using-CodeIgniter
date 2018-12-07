<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <i class="fa fa-smile-o"></i> Emotion recognition
        </h1>
    </section>

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
            <div class="col-md-12" <?php if ((!isset($image_input) && !isset($image_output))) echo 'hidden'; ?>>
                <div class="col-md-6">
                    <div class="box box-primary">
                        <div class="box-header">
                            <h3 class="box-title">Image input</h3>
                        </div>
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <img src="<?php if (isset($image_input)) echo base_url() . 'uploads/' . $image_input;?>" alt="image input" width="100%">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="box box-primary">
                        <div class="box-header">
                            <h3 class="box-title">Image output</h3>
                        </div>
                        <div class="box-body">
                            <div class="col-md-12">
                                <img src="<?php if (isset($image_output)) echo base_url() . 'outputs/' . $image_output;?>" alt="image output" width="100%">
                            </div>
                            <div class="row">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
