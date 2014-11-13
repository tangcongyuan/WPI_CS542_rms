<?php foreach ($building as $building_item): ?>

    <h2><?php echo $building_item['building_name'] ?></h2>
    <div class="main">
        <?php echo $building_item['location'] ?>
    </div>

    <p><a href="http://localhost/~Eric/rms/index.php/building/view/<?php echo $building_item['building_id'] ?>">View buildings</a></p>

<?php endforeach; ?>
