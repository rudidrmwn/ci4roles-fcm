<?= $this->extend("layouts/app") ?>

<?= $this->section("body") ?>

<div class="container" style="margin-top:20px;">
    <div class="row">
            <div class="panel panel-primary">
                <div class="panel-heading">Maker Dashboard</div>
                <div class="panel-body">
                    <h5>Hello, <?= session()->get('name') ?> | <a href="<?= site_url('logout') ?>">Logout</a></h5>
                <button type="button" class="btn btn-success mb-2" data-toggle="modal" data-target="#addModal">Add New</button>
                <div class="dropdown navbar-right">
                  <a id="dLabel" role="button" data-toggle="dropdown" data-target="#" href="/page.html">
                    <i class="glyphicon glyphicon-bell"></i>
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
                  <li class="present">
                    <span>
                      <strong>Step 1</strong>
                      Create
                    </span><i></i>
                  </li>
                  <li class="future">
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
                            <td><?php if($row->status=="draft"): ?>
                                <a href="#" class="btn btn-info btn-sm btn-edit" data-id="<?= $row->id_task;?>" data-title="<?= $row->task_title;?>" data-description="<?= $row->task_description;?>">Edit</a>
                                <a href="#" class="btn btn-danger btn-sm btn-delete" data-id="<?= $row->id_task;?>">Delete</a>
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
                <!-- Modal Add Task-->
                <form id="task_form" action="<?= base_url('/maker') ?>" method="post">
                    <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Add New Task</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                         
                            <div class="form-group">
                                <label class="control-label">Title</label>
                                <input type="text" class="form-control" id="title" name="task_title" placeholder="Title">
                            </div>
                             
                            <div class="form-group">
                                <label class="control-label">Description</label>
                                <textarea class="form-control" id="description" name="task_description" placeholder="Description"s cols="10" rows="10"></textarea>
                            </div>
                         
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                        </div>
                    </div>
                    </div>
                </form>
                <!-- End Modal Add Task-->
                 <!-- Modal Edit Task-->
                    <form action="<?=base_url('/maker/task/update')?>" method="post">
                        <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Edit Task</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                             
                                <div class="form-group">
                                    <label>Title</label>
                                    <input type="text" class="form-control title" name="task_title" placeholder="Task Title">
                                </div>
                                 
                                <div class="form-group">
                                    <label>Description</label>
                                    <input type="text" class="form-control description" name="task_description" placeholder="Task Description">
                                </div>
                             
                            </div>
                            <div class="modal-footer">
                                <input type="hidden" name="id_task" class="id_task">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Update</button>
                            </div>
                            </div>
                        </div>
                        </div>
                    </form>
                    <!-- End Modal Edit Task-->
                 
                    <!-- Modal Delete Task-->
                    <form action="<?=base_url('/maker/task/delete')?>" method="post">
                        <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Delete Task</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                             
                               <h4>Are you sure want to delete this task?</h4>
                             
                            </div>
                            <div class="modal-footer">
                                <input type="hidden" name="id_task" class="id_task">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                                <button type="submit" class="btn btn-primary">Yes</button>
                            </div>
                            </div>
                        </div>
                        </div>
                    </form>
                    <!-- End Modal Delete Task-->
                 
                    </div>
                </div>
            </div>
            <script>
                $(document).ready(function(){
             
                    // get Edit Task
                    $('.btn-edit').on('click',function(){
                        const id = $(this).data('id');
                        const title = $(this).data('title');
                        const description = $(this).data('description');
                        $('.id_task').val(id);
                        $('.title').val(title);
                        $('.description').val(description);
                        $('#editModal').modal('show');
                    });
                    // get Delete Task
                    $('.btn-delete').on('click',function(){
                        const id = $(this).data('id');
                        $('.id_task').val(id);
                        $('#deleteModal').modal('show');
                    });
                    
                });
            </script>
<?= $this->endSection() ?>