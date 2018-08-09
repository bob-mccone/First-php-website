<html>
    <div>
        <!-- If not logged in hide share something button-->
        <?php if(isset($_SESSION['is_logged_in'])) : ?>
        <!--Creating a link button -->
        <a class="btn btn-success btn-share" href="<?php echo ROOT_PATH; ?>shares/add">Share Something</a>
        <?php endif; ?>
        <!-- For each loop to display the shares from the database -->
        <?php foreach($viewmodel as $item) : ?>
            <div class="well">
                <!-- Displaying title -->
                <h3><?php echo $item['title']; ?></h3>
                <!-- Displaying date -->
                <small><?php echo $item['create_date']; ?></small>
                <hr />
                <!-- Displaying body -->
                <p><?php echo $item['body']; ?></p>
                <br />
                <!-- Button that will open in new tab by using _blank-->
                <a class="btn btn-default" href="<?php echo $item['link']; ?>" target="_blank">Go to website</a>
            </div>
        <?php endforeach; ?>
    </div>
</html>