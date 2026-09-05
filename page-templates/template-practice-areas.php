<?php
/**
 * Template Name: Practice Areas Directory
 *
 * @package ZCA_Legal
 */

get_header();

// Fetch Dynamic Taxonomy Terms for Practice Categories from Database
$practice_terms = get_terms(array(
    'taxonomy'   => 'practice_category',
    'hide_empty' => false,
    'orderby'    => 'name',
    'order'      => 'ASC'
));
?>

  <!-- Page Banner -->
  <section class="section section-dark" style="padding: 4rem 0 3.5rem; text-align: center; border-bottom: 2px solid var(--color-gold);">
    <div class="container">
      <span class="section-subtitle">Chamber Practice Directory</span>
      <h1 style="color: #fff; margin-bottom: 0.75rem;">Comprehensive Legal Practice Areas</h1>
      <p style="color: #cbd5e1; max-width: 680px; margin: 0 auto; font-size: 1.1rem;">
        Providing 360° legal intelligence, litigation advocacy, and commercial advisory across 24 core practice sectors in Bangladesh.
      </p>
    </div>
  </section>

  <!-- Practice Areas Search & Dynamic Category Filter Section -->
  <section class="section">
    <div class="container">
      
      <!-- Search Box & Filter Container -->
      <div class="filter-search-container">
        
        <!-- Live Instant Search Input (Desktop & Tablet) -->
        <div class="search-box-wrapper">
          <i class="fa-solid fa-magnifying-glass search-box-icon"></i>
          <input 
            type="text" 
            id="practiceSearchInput" 
            class="search-input-field" 
            placeholder="Search practice areas (e.g. Company, Writ, Cheque, Trademark, Tax, Land, Labor...)" 
            autocomplete="off"
          >
          <button type="button" id="practiceSearchClear" class="search-clear-btn" title="Clear search">&times;</button>
        </div>

        <!-- Mobile Filter Button (Triggers Off-Canvas Drawer) -->
        <div class="mobile-filter-bar">
          <button type="button" class="mobile-filter-btn" id="practiceFilterTriggerBtn" onclick="openFilterDrawer('practiceFilterDrawer')">
            <i class="fa-solid fa-sliders"></i> Filter & Categories
          </button>
        </div>

        <!-- Desktop Category Filter Tabs (Dynamically Fetched from practice_category Taxonomy) -->
        <?php
        $selected_cat = isset($_GET['category']) ? sanitize_text_field($_GET['category']) : 'all';
        $page_base_url = get_permalink();
        ?>
        <div class="filter-tabs" id="practiceFilterTabs">
          <a href="<?php echo esc_url($page_base_url); ?>" class="filter-tab-btn practice-filter-btn <?php echo ($selected_cat === 'all') ? 'active' : ''; ?>" data-category="all">
            All Practice Sectors
          </a>
          <?php if (!empty($practice_terms) && !is_wp_error($practice_terms)) : ?>
            <?php foreach ($practice_terms as $term) : 
              $cat_url = add_query_arg('category', $term->slug, $page_base_url);
              $is_active = ($selected_cat === $term->slug);
            ?>
              <a href="<?php echo esc_url($cat_url); ?>" class="filter-tab-btn practice-filter-btn <?php echo $is_active ? 'active' : ''; ?>" data-category="<?php echo esc_attr($term->slug); ?>">
                <?php echo esc_html($term->name); ?> (<?php echo intval($term->count); ?>)
              </a>
            <?php endforeach; ?>
          <?php else: ?>
            <!-- Fallback Static Categories -->
            <?php
            $default_p_cats = array(
                'corporate'  => 'Corporate & Commercial',
                'litigation' => 'Litigation & Court Appeals',
                'tax'        => 'Taxation & Finance',
                'property'   => 'Real Estate & Property',
                'advisory'   => 'Advisory & Compliance'
            );
            foreach ($default_p_cats as $c_slug => $c_label) :
              $cat_url = add_query_arg('category', $c_slug, $page_base_url);
            ?>
              <a href="<?php echo esc_url($cat_url); ?>" class="filter-tab-btn practice-filter-btn <?php echo ($selected_cat === $c_slug) ? 'active' : ''; ?>" data-category="<?php echo esc_attr($c_slug); ?>">
                <?php echo esc_html($c_label); ?>
              </a>
            <?php endforeach; ?>
          <?php endif; ?>
        </div>

        <!-- Real-time Count Info -->
        <?php
        $paged = (get_query_var('paged')) ? get_query_var('paged') : ((isset($_GET['paged'])) ? intval($_GET['paged']) : ((get_query_var('page')) ? get_query_var('page') : 1));
        $p_query_args = array(
            'post_type'      => 'practice_area',
            'posts_per_page' => 12,
            'paged'          => $paged,
            'post_status'    => 'publish',
            'orderby'        => 'menu_order',
            'order'          => 'ASC'
        );
        if ($selected_cat !== 'all') {
            $p_query_args['tax_query'] = array(
                array(
                    'taxonomy' => 'practice_category',
                    'field'    => 'slug',
                    'terms'    => $selected_cat,
                ),
            );
        }
        $p_query = new WP_Query($p_query_args);

        if ($selected_cat !== 'all') {
            $term_obj = get_term_by('slug', $selected_cat, 'practice_category');
            $term_name_display = $term_obj ? $term_obj->name : ucfirst($selected_cat);
            $count_msg = sprintf('Showing %d practice area%s in "%s"', $p_query->found_posts, ($p_query->found_posts !== 1 ? 's' : ''), esc_html($term_name_display));
        } else {
            $count_msg = sprintf('Showing all %d practice areas', $p_query->found_posts);
        }
        ?>
        <div id="practiceCountInfo" class="search-results-info"><?php echo esc_html($count_msg); ?></div>
      </div>

      <!-- Practice Image Cards Grid (Dynamic CPT Query with Pagination) -->
      <div class="practice-image-grid" id="practiceGridContainer">
        <?php
        if ($p_query->have_posts()) : while ($p_query->have_posts()) : $p_query->the_post();
            $icon = get_post_meta(get_the_ID(), '_zca_practice_icon', true);
            if (!$icon) $icon = 'fa-solid fa-scale-balanced';
            $badge = get_post_meta(get_the_ID(), '_zca_practice_badge', true);
            
            $terms = get_the_terms(get_the_ID(), 'practice_category');
            $term_slugs = array();
            $cat_name = 'Practice Domain';
            if ($terms && !is_wp_error($terms)) {
                foreach ($terms as $t) {
                    $term_slugs[] = $t->slug;
                }
                $cat_name = $terms[0]->name;
            }
            $cat_data_attr = !empty($term_slugs) ? implode(' ', $term_slugs) : 'all';
            
            $img_url = get_the_post_thumbnail_url(get_the_ID(), 'zca-card-thumb');
            if (!$img_url) {
                $default_images = array(
                    'adv-zahid-presentation.jpeg',
                    'adv-zahid-chamber-meeting.jpeg',
                    'WhatsApp Image 2026-08-22 at 13.51.52.jpeg',
                    'WhatsApp Image 2026-08-22 at 13.51.45.jpeg',
                    'certificate-dcci.jpeg',
                    'adv-zahid-speaking.jpeg',
                    'award-star-excellence-2025.jpeg',
                    'award-global-iconic-2026.jpeg',
                    'adv-zahid-dcci-induction.jpeg'
                );
                $img_url = get_template_directory_uri() . '/assets/images/' . $default_images[get_the_ID() % count($default_images)];
            }
        ?>
            <div class="practice-img-card" data-category="<?php echo esc_attr($cat_data_attr); ?>">
              <div class="practice-card-thumb">
                <img src="<?php echo esc_url($img_url); ?>" alt="<?php the_title_attribute(); ?>">
                <div class="practice-thumb-overlay"></div>
                <div class="practice-thumb-icon"><?php echo zca_get_practice_svg_icon(get_the_title() . ' ' . $icon); ?></div>
              </div>
              <div class="practice-card-body">
                <span class="practice-card-badge"><?php echo esc_html($cat_name); ?></span>
                <h3 class="practice-card-heading"><?php the_title(); ?></h3>
                <p class="practice-card-text"><?php echo esc_html(wp_trim_words(get_the_excerpt(), 22)); ?></p>
                <div class="practice-card-footer">
                  <a href="<?php the_permalink(); ?>" class="practice-card-link">View Full Scope <i class="fa-solid fa-arrow-right"></i></a>
                  <button class="btn btn-sm btn-outline-gold" onclick="openModal('consultationModal')">Book</button>
                </div>
              </div>
            </div>
        <?php endwhile; wp_reset_postdata(); endif; ?>

        <!-- No Results Fallback Card -->
        <div id="practiceNoResults" class="no-results-box" style="<?php echo ($p_query->have_posts()) ? 'display: none;' : 'display: block;'; ?>">
          <i class="fa-solid fa-folder-open"></i>
          <h3 style="font-size: 1.25rem; color: #091528; margin-bottom: 0.5rem;">No Practice Areas Found</h3>
          <p style="font-size: 0.9rem; color: #64748b; margin-bottom: 1.25rem;">
            We couldn't find any legal practice areas matching your search criteria or selected category.
          </p>
          <a href="<?php echo esc_url($page_base_url); ?>" class="btn btn-sm btn-primary">
            <i class="fa-solid fa-rotate-left"></i> Reset Search & Filters
          </a>
        </div>

      </div>

      <!-- Pagination Controls (12 Practice Areas Per Page) -->
      <?php if ($p_query->max_num_pages > 1) : ?>
        <div class="pagination-wrapper" id="practicePaginationWrapper">
          <?php
          $big = 999999999;
          $paginate_base = str_replace($big, '%#%', esc_url(get_pagenum_link($big)));
          if ($selected_cat !== 'all') {
              $paginate_base = add_query_arg('category', $selected_cat, $paginate_base);
          }
          echo paginate_links(array(
              'base'      => $paginate_base,
              'format'    => '?paged=%#%',
              'current'   => max(1, $paged),
              'total'     => $p_query->max_num_pages,
              'prev_text' => '<i class="fa-solid fa-chevron-left"></i> Prev',
              'next_text' => 'Next <i class="fa-solid fa-chevron-right"></i>',
              'type'      => 'plain',
          ));
          ?>
        </div>
      <?php else: ?>
        <div class="pagination-wrapper" id="practicePaginationWrapper" style="display: none;"></div>
      <?php endif; ?>

    </div>
  </section>


  <!-- Mobile Off-Canvas Filter Drawer Component -->
  <div class="offcanvas-filter-backdrop" id="filterDrawerBackdrop"></div>
  
  <div class="offcanvas-filter-drawer" id="practiceFilterDrawer">
    <div class="offcanvas-header">
      <div class="offcanvas-title"><i class="fa-solid fa-sliders"></i> Filter Practice Areas</div>
      <button type="button" class="offcanvas-close-btn" onclick="closeFilterDrawer('practiceFilterDrawer')">&times;</button>
    </div>
    
    <div class="offcanvas-body">
      <!-- Search Inside Drawer -->
      <div class="offcanvas-section-title">Instant Keyword Search</div>
      <div style="margin-bottom: 1.5rem; position: relative;">
        <input 
          type="text" 
          id="practiceMobileSearch" 
          class="form-control" 
          placeholder="Type to search (e.g. Writ, Tax...)" 
          style="border-radius: var(--radius-pill); padding-left: 1rem;"
        >
      </div>

      <!-- Real Categories in Drawer -->
      <div class="offcanvas-section-title">Select Practice Category</div>
      <div class="offcanvas-category-list">
        <a href="<?php echo esc_url($page_base_url); ?>" class="offcanvas-cat-item practice-offcanvas-cat <?php echo ($selected_cat === 'all') ? 'active' : ''; ?>" data-category="all">
          <span>All Practice Sectors</span>
          <?php if ($selected_cat === 'all'): ?><i class="fa-solid fa-check"></i><?php endif; ?>
        </a>
        <?php if (!empty($practice_terms) && !is_wp_error($practice_terms)) : ?>
          <?php foreach ($practice_terms as $term) : 
            $cat_url = add_query_arg('category', $term->slug, $page_base_url);
            $is_active = ($selected_cat === $term->slug);
          ?>
            <a href="<?php echo esc_url($cat_url); ?>" class="offcanvas-cat-item practice-offcanvas-cat <?php echo $is_active ? 'active' : ''; ?>" data-category="<?php echo esc_attr($term->slug); ?>">
              <span><?php echo esc_html($term->name); ?></span>
              <span style="font-size: 0.75rem; background: rgba(0,0,0,0.06); padding: 2px 6px; border-radius: 4px;"><?php echo intval($term->count); ?></span>
              <?php if ($is_active): ?><i class="fa-solid fa-check"></i><?php endif; ?>
            </a>
          <?php endforeach; ?>
        <?php else: ?>
          <?php foreach ($default_p_cats as $c_slug => $c_label) :
            $cat_url = add_query_arg('category', $c_slug, $page_base_url);
            $is_active = ($selected_cat === $c_slug);
          ?>
            <a href="<?php echo esc_url($cat_url); ?>" class="offcanvas-cat-item practice-offcanvas-cat <?php echo $is_active ? 'active' : ''; ?>" data-category="<?php echo esc_attr($c_slug); ?>">
              <span><?php echo esc_html($c_label); ?></span>
              <?php if ($is_active): ?><i class="fa-solid fa-check"></i><?php endif; ?>
            </a>
          <?php endforeach; ?>
        <?php endif; ?>
      </div>
    </div>

    <div class="offcanvas-footer">
      <button type="button" class="btn btn-navy btn-sm" style="flex: 1;" onclick="resetPracticeFilters()">
        <i class="fa-solid fa-rotate-left"></i> Reset
      </button>
      <button type="button" class="btn btn-primary btn-sm" style="flex: 1;" onclick="closeFilterDrawer('practiceFilterDrawer')">
        Done
      </button>
    </div>
  </div>

<?php
get_footer();
