<?php
/*
 * Render a page.
 * Layout areas and page content area are rendered.
 *
 * Available vars :
 * - dmFrontPageHelper $helper      ( page_helper service )
 * - boolean           $isEditMode  ( whether the user is allowed to edit page )
 */
?>

<div id="dm_page"<?php $isEditMode && print ' class="edit"' ?>>

  <div class="dm_layout">

    <div class="container">
          <?php echo $helper->renderArea('layout.top', '.clearfix') ?>

          <?php echo $helper->renderArea('page.content') ?>

          <?php echo $helper->renderArea('layout.left') ?>
<?php /*
        <div class="span2">
          <?php echo $helper->renderArea('layout.right') ?>
        </div>
      </div>
*/ ?>
          <?php echo $helper->renderArea('layout.bottom', '.clearfix') ?>
    </div>

  </div>

</div>