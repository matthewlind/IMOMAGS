<?php
$cat = get_query_var('cat');
$category = get_category ($cat);
$catSlug = $category->slug;
?>


<div data-position="<?php echo $dataPos = $dataPos + 1; ?>" class="page-header clearfix js-responsive-section">
    <h1 class="page-title" cat-title="<?php echo single_cat_title( '', false ); ?>">
	<div class="icon"></div>
    <?php
        printf('<span>Reader Photos: ' . single_cat_title( '', false ) . '</span>' );
        ?>
    </h1>
    <div class="sponsor"><?php imo_dart_tag("240x60"); ?></div>
</div>
        <div class="nav-share">
            <label class="upload-button">
                <a href="/add-new-photo/"><span class="singl-post-photo"><span>Share Your Photo Now!</span></span></a>
                <input id="image-upload" class="common-image-upload" type="file" name="photo-upload">
            </label>
        </div>
        <div class="btn-group btn-bar">
            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
            <span class="menu-title browse-community" style="text-transform:normal;">Browse by State</span> <span class="caret"></span>
            </button>
            <ul class="dropdown-menu filter" role="menu">
                <li><a href="" class="filter-menu" state="AL">alabama</a></li><div class="divider"></div>
                <li><a href="" class="filter-menu" state="AK">alaska</a></li><div class="divider"></div>
                <li><a href="" class="filter-menu" state="AZ">arizona</a></li><div class="divider"></div>
                <li><a href="" class="filter-menu" state="AR">arkansas</a></li><div class="divider"></div>
                <li><a href="" class="filter-menu" state="CA">california</a></li><div class="divider"></div>
                <li><a href="" class="filter-menu" state="CO">colorado</a></li><div class="divider"></div>
                <li><a href="" class="filter-menu" state="CT">connecticut</a></li><div class="divider"></div>
                <li><a href="" class="filter-menu" state="DE">delaware</a></li><div class="divider"></div>
                <li><a href="" class="filter-menu" state="DC">district of columbia</a></li><div class="divider"></div>
                <li><a href="" class="filter-menu" state="FL">florida</a></li><div class="divider"></div>
                <li><a href="" class="filter-menu" state="GA">georgia</a></li><div class="divider"></div>
                <li><a href="" class="filter-menu" state="HI">hawaii</a></li><div class="divider"></div>
                <li><a href="" class="filter-menu" state="ID">idaho</a></li><div class="divider"></div>
                <li><a href="" class="filter-menu" state="IL">illinois</a></li><div class="divider"></div>
                <li><a href="" class="filter-menu" state="IN">indiana</a></li><div class="divider"></div>
                <li><a href="" class="filter-menu" state="IA">iowa</a></li><div class="divider"></div>
                <li><a href="" class="filter-menu" state="KS">kansas</a></li><div class="divider"></div>
                <li><a href="" class="filter-menu" state="KY">kentucky</a></li><div class="divider"></div>
                <li><a href="" class="filter-menu" state="LA">louisiana</a></li><div class="divider"></div>
                <li><a href="" class="filter-menu" state="ME">maine</a></li><div class="divider"></div>
                <li><a href="" class="filter-menu" state="MD">maryland</a></li><div class="divider"></div>
                <li><a href="" class="filter-menu" state="MA">massachusetts</a></li><div class="divider"></div>
                <li><a href="" class="filter-menu" state="MI">michigan</a></li><div class="divider"></div>
                <li><a href="" class="filter-menu" state="MN">minnesota</a></li><div class="divider"></div>
                <li><a href="" class="filter-menu" state="MS">mississippi</a></li><div class="divider"></div>
                <li><a href="" class="filter-menu" state="MO">missouri</a></li><div class="divider"></div>
                <li><a href="" class="filter-menu" state="MT">montana</a></li><div class="divider"></div>
                <li><a href="" class="filter-menu" state="NE">nebraska</a></li><div class="divider"></div>
                <li><a href="" class="filter-menu" state="NV">nevada</a></li><div class="divider"></div>
                <li><a href="" class="filter-menu" state="NH">new hampshire</a></li><div class="divider"></div>
                <li><a href="" class="filter-menu" state="NJ">new jersey</a></li><div class="divider"></div>
                <li><a href="" class="filter-menu" state="NM">new mexico</a></li><div class="divider"></div>
                <li><a href="" class="filter-menu" state="NY">new york</a></li><div class="divider"></div>
                <li><a href="" class="filter-menu" state="NC">north carolina</a></li><div class="divider"></div>
                <li><a href="" class="filter-menu" state="ND">north dakota</a></li><div class="divider"></div>
                <li><a href="" class="filter-menu" state="OH">ohio</a></li><div class="divider"></div>
                <li><a href="" class="filter-menu" state="OK">oklahoma</a></li><div class="divider"></div>
                <li><a href="" class="filter-menu" state="OR">oregon</a></li><div class="divider"></div>
                <li><a href="" class="filter-menu" state="PA">pennsylvania</a></li><div class="divider"></div>
                <li><a href="" class="filter-menu" state="RI">rhode island</a></li><div class="divider"></div>
                <li><a href="" class="filter-menu" state="SC">south carolina</a></li><div class="divider"></div>
                <li><a href="" class="filter-menu" state="SD">south dakota</a></li><div class="divider"></div>
                <li><a href="" class="filter-menu" state="TN">tennessee</a></li><div class="divider"></div>
                <li><a href="" class="filter-menu" state="TX">texas</a></li><div class="divider"></div>
                <li><a href="" class="filter-menu" state="UT">utah</a></li><div class="divider"></div>
                <li><a href="" class="filter-menu" state="VT">vermont</a></li><div class="divider"></div>
                <li><a href="" class="filter-menu" state="VA">virginia</a></li><div class="divider"></div>
                <li><a href="" class="filter-menu" state="WA">washington</a></li><div class="divider"></div>
                <li><a href="" class="filter-menu" state="WV">west virginia</a></li><div class="divider"></div>
                <li><a href="" class="filter-menu" state="WI">wisconsin</a></li><div class="divider"></div>
                <li><a href="" class="filter-menu" state="WY">wyoming</a></li><div class="divider"></div>
            </ul>
        </div>

<div class='community-posts'>
    <div data-position="<?php echo $dataPos = $dataPos + 1; ?>" class="posts-list js-responsive-section main-content-preppend" slug="<?php echo $catSlug; ?>">
    	<?php $i = 1; while ( have_posts() ) : the_post(); ?>

            <?php
                /* Include the Post-Format-specific template for the content.
                 * If you want to overload this in a child theme then include a file
                 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
                 */
                get_template_part( 'content/content-reader_photos', get_post_format() );

                $community_category = get_category( get_query_var( 'cat' ) );
    			$community_cat = $community_category->slug;
            ?>


        <?php if ( (($i - (($paged -1) * 2 ))%6) == 0 ): ?>

            <?php if ( mobile() ){ ?>
            <div class="image-banner posts-image-banner">
                <?php imo_dart_tag("300x250",array("pos"=>"mob")); ?>
            </div>
            <?php } ?>
        <?php endif;?>

        <?php $i++; endwhile; ?>

    </div>
</div>

<div class="community-pager">

    <a href="" class="more btn-red">Load More</a>

</div>
