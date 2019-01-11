<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <i class="fa fa-users"></i> Student Management
        <small>Add, Edit, Delete</small>
      </h1>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-xs-12 text-right">
                <div class="form-group">
                    <a class="btn btn-primary" href="<?php echo base_url(); ?>hust/add_student"><i class="fa fa-plus"></i> Add New</a>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Student List</h3>
                    <div class="box-tools">
                        <form action="<?php echo base_url() ?>student_info" method="POST" id="searchList">
                            <div class="input-group">
                              <input type="text" name="searchText" value="<?php echo $searchText; ?>" class="form-control input-sm pull-right" style="width: 150px;" placeholder="Search"/>
                              <div class="input-group-btn">
                                <button class="btn btn-sm btn-default searchList"><i class="fa fa-search"></i></button>
                              </div>
                            </div>
                        </form>
                    </div>
                </div><!-- /.box-header -->
                <div class="box-body table-responsive no-padding">
                  <table class="table table-hover">
                      <tr>
                          <th><input type="text" id="ID"  placeholder="Mã SV" style="width: 50px;"/></th>
                          <th><input type="text" id="student_name"  placeholder="Tên SV"  style="width: 50px;"/></th>
                          <th><input type="text" id="department_name"  placeholder="Khoa/Viện"  style="width: 70px;"/></th>
                          <th><input type="text" id="year" placeholder="Năm"  style="width: 50px;"/></th>
                          <th><input type="text" id="course_id" placeholder="Mã môn học"  style="width: 100px;"/></th>
                          <th><input type="text" id="dept_name"  placeholder="Môn học"  style="width: 100px;"/></th>
                          <th><input type="text" id="semester"  placeholder="Học kì"  style="width: 70px;"/></th>
                          <th><input type="text" id="teacher_name" placeholder="Giáo viên"  style="width: 70px;"/></th>
                          <th><input type="text" id="room_number" placeholder="Phòng học"  style="width: 70px;"/></th>
                          <th><input type="text" id="building" placeholder="Tòa nhà"  style="width: 70px;"/></th>
                          <th>Thời gian</th>
                          <th>Actions</th>
                      </tr>
                    <?php
                    if(!empty($userRecords))
                    {
                        foreach($userRecords as $record)
                        {
                    ?>
                    <tr>
                        <td><?php echo $record->ID ?></td>
                        <td><?php echo $record->student_name ?></td>
                        <td><?php echo $record->department_name ?></td>
                        <td><?php echo $record->year ?></td>
                        <td><?php echo $record->course_id ?></td>
                        <td><?php echo $record->dept_name ?></td>
                        <td><?php echo $record->semester ?></td>
                        <td><?php echo $record->teacher_name ?></td>
                        <td><?php echo $record->room_number ?></td>
                        <td><?php echo $record->building ?></td>
                        <td><?php echo $record->time ?></td>
                        <td class="text-center">
                            <a class="btn btn-sm btn-info" href="<?php echo base_url().'hust/edit_student/'.$record->ID; ?>" title="Edit"><i class="fa fa-pencil"></i></a>
                            <a class="btn btn-sm btn-danger delete_student" href="#" data-userid="<?php echo $record->ID; ?>" title="Delete"><i class="fa fa-trash"></i></a>
                        </td>
                    </tr>
                    <?php
                        }
                    }
                    ?>
                  </table>
                  
                </div><!-- /.box-body -->
                <div class="box-footer clearfix">
                    <?php echo $this->pagination->create_links(); ?>
                </div>
              </div><!-- /.box -->
            </div>
        </div>
    </section>
</div>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/delete_student2.js" charset="utf-8"></script>
<script type="text/javascript">
    jQuery(document).ready(function(){
        jQuery('ul.pagination li a').click(function (e) {
            e.preventDefault();            
            var link = jQuery(this).get(0).href;            
            var value = link.substring(link.lastIndexOf('/') + 1);
            jQuery("#searchList").attr("action", baseURL + "student_info/" + value);
            jQuery("#searchList").submit();
        });
    });


    $(document).ready(function(){
        $("#ID").on('change', function postinput(){
            var matchvalue = $(this).val();
            $(location).attr('href', baseURL + "hust/find_student_info?ID=" + matchvalue)
        });
        $("#student_name").on('change', function postinput(){
            var matchvalue = $(this).val();
            $(location).attr('href', baseURL + "hust/find_student_info?student_name=" + matchvalue)
        });
        $("#department_name").on('change', function postinput(){
            var matchvalue = $(this).val();
            $(location).attr('href', baseURL + "hust/find_student_info?department_name=" + matchvalue)
        });
        $("#year").on('change', function postinput(){
            var matchvalue = $(this).val();
            $(location).attr('href', baseURL + "hust/find_student_info?year=" + matchvalue)
        });$("#dept_name").on('change', function postinput(){
            var matchvalue = $(this).val();
            $(location).attr('href', baseURL + "hust/find_student_info?dept_name=" + matchvalue)
        });$("#semester").on('change', function postinput(){
            var matchvalue = $(this).val();
            $(location).attr('href', baseURL + "hust/find_student_info?semester=" + matchvalue)
        });$("#course_id").on('change', function postinput(){
            var matchvalue = $(this).val();
            $(location).attr('href', baseURL + "hust/find_student_info?course_id=" + matchvalue)
        });$("#teacher_name").on('change', function postinput(){
            var matchvalue = $(this).val();
            $(location).attr('href', baseURL + "hust/find_student_info?teacher_name=" + matchvalue)
        });$("#room_number").on('change', function postinput(){
            var matchvalue = $(this).val();
            $(location).attr('href', baseURL + "hust/find_student_info?room_number=" + matchvalue)
        });$("#building").on('change', function postinput(){
            var matchvalue = $(this).val();
            $(location).attr('href', baseURL + "hust/find_student_info?building=" + matchvalue)
        });
    });
</script>
