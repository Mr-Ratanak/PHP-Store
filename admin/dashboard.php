<?php
session_start(); 
$admin_id = $_SESSION['admin_id'];
if(!isset($admin_id)){
    header('location:../admin-login.php');
}

    require_once '../components/admin_header.php';
    require_once '../components/config.php';
    $count = new Database();
    

    

?>

<div class="row admin-content">
                    <div class="col-lg-12" >
                        <div class="card-deck mt-3 text-light text-center fw-bold d-flex justify-content-between">
                            <div class="card bg-primary" style="width: 24%;">
                                <div class="card-header">Total Users</div>
                                <div class="card-body">
                                    <div class="display-4 text-white fs-2"><?= $count->totalCount('users');  ?></div>
                                </div>
                            </div>
                            <div class="card bg-warning" style="width: 24%;">
                                <div class="card-header">Welcome Admin</div>
                                <div class="card-body">
                                    <div class="display-4 text-white fs-2"><?= $count->totalCount('admins'); ?></div>
                                </div>
                            </div>
                            <div class="card bg-success" style="width: 24%;">
                                <div class="card-header">Total pending</div>
                                <div class="card-body">
                                    <div class="display-4 text-white fs-2">$<?= $count->totalPending(); ?>/-</div>
                                </div>
                            </div>
                            <div class="card bg-danger" style="width: 24%;">
                                <div class="card-header">Website Views</div>
                                <div class="card-body">
                                    <div class="display-4 text-white fs-2">
                                        none
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="card-deck mt-3 text-light text-center fw-bold d-flex justify-content-between">
                            <div class="card bg-danger" style="width: 32%;">
                                <div class="card-header">Completed Order</div>
                                <div class="card-body">
                                    <div class="display-4 fs-2 text-white">$<?= $count->totalCompleted(); ?>/-</div>
                                </div>
                            </div>
                            <div class="card bg-secondary" style="width: 32%;">
                                <div class="card-header">Total Feedbacks</div>
                                <div class="card-body">
                                    <div class="display-4 fs-2 text-white">none</div>
                                </div>
                            </div>
                            <div class="card bg-info" style="width: 32%;">
                                <div class="card-header">Total Notifications</div>
                                <div class="card-body">
                                    <div class="display-4 fs-2 text-white">None</div>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="card-deck mt-3 text-light text-center fw-bold d-flex justify-content-between">
                            <div class="card bg-warning" style="width: 32%;">
                                <div class="card-header">Order placed</div>
                                <div class="card-body">
                                    <div class="display-4"><?= $count->totalCountOrder('orders'); ?></div>
                                </div>
                            </div>
                            <div class="card bg-danger" style="width: 32%;">
                                <div class="card-header">New messages</div>
                                <div class="card-body">
                                    <div class="display-4"><?= $count->totalCount('messages'); ?></div>
                                </div>
                            </div>
                            <div class="card bg-primary" style="width: 32%;">
                                <div class="card-header">Producs added</div>
                                <div class="card-body">
                                    <div class="display-4"><?= $count->totalCount('products'); ?></div>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                </div>
                <div class="row d-flex justify-content-between">
                    <div class="col-lg-6">
                        <div class="card my-3 border border-1" >
                        <div class="card-deck text-light text-center fw-bold" >
                            <div class="card bg-success rounded-0" >
                                <div class="card-header">Male/Female User's Percentage</div>
                                <div class="bg-white d-flex justify-content-center" id="chartOne" style="width: 100%; height: 400px; ">
                                    <div id="piechart" style="width: 800px; height: 400px;"></div>
                                </div>
                            </div>
                        </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="card my-3 border border-1 ">
                        <div class="card-deck text-light text-center fw-bold" >
                            <div class="card bg-dark rounded-0" >
                                <div class="card-header text-white">Verified/Unverified User's Percentage</div>
                                <div class="bg-white d-flex justify-content-center" id="chartTwo" style="width:100%; height: 400px;">
                                    <div id="piechart2" style="width: 800px; height: 400px;"></div>
                                </div>
                            </div>
                        </div>
                        </div>
                    </div>
                </div>

            </div>
    </div>
</div>