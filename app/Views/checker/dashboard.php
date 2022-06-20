<?= $this->extend("layouts/app") ?>

<?= $this->section("body") ?>

<div class="container" style="margin-top:20px;">
    <div class="row">
        <div class="panel panel-primary">
            <div class="panel-heading">Checker Dashboard</div>
            <div class="panel-body">
                <h5>Hello, <?= session()->get('name') ?> | <a href="<?= site_url('logout') ?>">Logout</a></h5>
                 <div class="dropdown navbar-right">
                  <a id="dLabel" role="button" data-toggle="dropdown" data-target="#" href="/page.html">
                    <i class="glyphicon glyphicon-bell"></i><span class="badge badge-warning" id="notif"></span>
                  </a>
                  
                  <ul class="dropdown-menu notifications" role="menu" aria-labelledby="dLabel">
                    
                    <div class="notification-heading"><h4 class="menu-title">Notifications</h4><h4 class="menu-title pull-right">View all<i class="glyphicon glyphicon-circle-arrow-right"></i></h4>
                    </div>
                    <li class="divider"></li>
                   <div class="notifications-wrapper">
                     
                   </div>
                    <li class="divider"></li>
                    <div class="notification-footer"><h4 class="menu-title">View all<i class="glyphicon glyphicon-circle-arrow-right"></i></h4></div>
                  </ul>
                  
                </div>
                <ul class="steps">
                  <li class="past">
                    <span>
                      <strong>Step 1</strong>
                      Create
                    </span><i></i>
                  </li>
                  <li class="present">
                    <span>
                      <strong>Step 2</strong>
                      Check 
                    </span><i></i>
                  </li>
                  <li class="future">
                    <span>
                      <strong>Step 3</strong>
                      Approve 
                    </span><i></i>
                  </li>
                </ul>

               <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Task Title</th>
                            <th>Task Description</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php foreach($tasks as $row):?>
                        <tr>
                            <td><?= $row->task_title;?></td>
                            <td><?= $row->task_description;?></td>
                            <td><?= $row->status;?></td>
                            <td>
                                <?php
                                if($row->status=="draft"):
                                ?>
                               <a href="#" class="btn btn-info btn-sm btn-review" data-id="<?= $row->id_task;?>" data-title="<?= $row->task_title;?>" data-description="<?= $row->task_description;?>">View</a>
                              <?php
                                elseif($row->status=="checked"):
                                    echo "task telah dicek";
                                else:
                                    echo "task telah disetujui";
                                endif;
                                ?>
                            </td>
                        </tr>
                    <?php endforeach;?> 
                    </tbody>
                </table>
                 <!-- Modal Review Task-->
                <form action="<?=base_url('/checker/task/update')?>" method="post">
                    <div class="modal fade" id="reviewModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Review Task</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                         
                            <div class="form-group">
                                <label>Title</label>
                                <div class="title"></div>
                            </div>
                             
                            <div class="form-group">
                                <label>Description</label>
                                <div class="description"></div>
                            </div>
                         
                        </div>
                        <div class="modal-footer">
                            <input type="hidden" class="task_title" name="task_title">
                            <input type="hidden" class="task_description" name="task_description">
                            <input type="hidden" id="token" name="token">
                            <input type="hidden" name="id_task" class="id_task">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-primary">Assign</button>
                        </div>
                        </div>
                    </div>
                    </div>
                </form>
                <!-- End Modal Review Task-->
            </div>
        </div>
    </div>
</div>
<script>
$(document).ready(function(){
    $('.btn-review').click(function(){
        const id = $(this).data('id');
        const title = $(this).data('title');
        const description = $(this).data('description');
        $('.id_task').val(id);
        $('div.title').html(title);
        $('div.description').html(description);
        $('.task_title').val(title);
        $('.task_description').val(description);
        $('#reviewModal').modal('show');
    });
    
    function fetch() {
        $.getJSON("<?=base_url('/checker/task/notif')?>", function(datas) {
            $("#notif").html(datas.length);

            jQuery.each( datas, function( i, val ) {
                $(".notifications-wrapper").append('<a class="content" href="#"><div class="notification-item"><h4 class="item-title">'+ val.task_title +'</h4><p class="item-info">'+ val.task_description +'</p></div></a>')
            });
        });
    }
    
    setInterval(fetch, 3000);
    fetch();
});

</script>

<?= $this->endSection() ?>