<?php include("includes/header.php"); ?>
<?php 

$page = !empty($_GET['page']) ? (int)$_GET['page'] : 1;

$page_items = 2;

$page_total_items = Photo::countRecords();

$paginate = new Paginate($page, $page_items, $page_total_items);

$sql = "SELECT * FROM photos LIMIT {$page_items} OFFSET {$paginate->offset()}";

$photos = Photo::find_by_query($sql);

?>

        <div class="row">

            <!-- Entries Column -->
            <div class="col-md-12"> 
                <div class="thumbnail row">
                    <?php foreach ($photos as $photo) : ?>
                        <div class="col-xs-6 col-md-3">
                            <a class="thumbnail" href="photo.php?id=<?php echo $photo->id; ?>">
                                <img class="img-responsive gallery-home-photo" src="admin/<?php echo $photo->picture_path(); ?>" alt="">
                            </a>
                        </div>
                    <?php endforeach; ?> 
                </div>

                <div class="row">
                    <ul class="pager">
                    <?php 
                    
                    if($paginate->page_total() > 1) {
                        if($paginate->hes_next()) {
                            echo "<li class='next'><a href='index.php?page={$paginate->next()}'>Next <i class='fa fa-arrow-right'></i></a></li>";
                        } else {
                            echo "<li class='next disabled'><a href='#'>Next <i class='fa fa-arrow-right'></i></a></li>";
                        }

                        for ($i=1; $i <= $paginate->page_total(); $i++) { 
                            if($i == $paginate->current_page) {
                                echo "<li class='active disabled'><a class='page-link' href='#'>{$i}</a></li>";
                            } else {
                                echo "<li class='page-item'><a class='page-link' href='index.php?page={$i}'>{$i}</a></li>";
                            }
                            
                        }

                        if($paginate->hes_previous()) {
                            echo "<li class='previous'><a href='index.php?page={$paginate->previous()}'><i class='fa fa-arrow-left'></i> Previous</a></li>";
                        } else {
                            echo "<li class='previous disabled'><a href='#'><i class='fa fa-arrow-left'></i> Previous</a></li>";
                        }
                    }
                    
                    ?>
                    </ul>
                </div>
            </div>

            <!-- Blog Sidebar Widgets Column -->
            <!-- <div class="col-md-4"> -->
         
                 <!-- <?php //include("includes/sidebar.php"); ?> -->

        </div><!-- /.row -->

        <?php include("includes/footer.php"); ?>
