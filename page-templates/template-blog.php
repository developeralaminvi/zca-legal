<?php
/**
 * Template Name: Legal Blog Directory
 *
 * @package ZCA_Legal
 */

get_header();

// Fetch Dynamic WordPress Categories from Posts > Categories
$blog_categories = get_categories(array(
    'hide_empty' => false,
    'orderby'    => 'name',
    'order'      => 'ASC'
));
?>

  <!-- Page Banner -->
  <section class="section section-dark" style="padding: 4rem 0 3.5rem; text-align: center; border-bottom: 2px solid var(--color-gold);">
    <div class="container">
      <span class="section-subtitle">Chamber Legal Blog</span>
      <h1 style="color: #fff; margin-bottom: 0.75rem;">Legal Insights, Analysis & Guides</h1>
      <p style="color: #cbd5e1; max-width: 680px; margin: 0 auto; font-size: 1.1rem;">
        Practical legal analysis on startup compliance, trust laws, AI regulation, employment standards, and litigation strategy.
      </p>
    </div>
  </section>

  <!-- Blog Search & Dynamic WordPress Category Filter Section -->
  <section class="section">
    <div class="container">
      
      <!-- Search Box & Filter Container -->
      <div class="filter-search-container">
        
        <!-- Live Instant Search Input (Desktop & Tablet) -->
        <div class="search-box-wrapper">
          <i class="fa-solid fa-magnifying-glass search-box-icon"></i>
          <input 
            type="text" 
            id="blogSearchInput" 
            class="search-input-field" 
            placeholder="Search legal articles (e.g. Startup, Trust, Cyber, Labor, Trademark, Cheque...)" 
            autocomplete="off"
          >
          <button type="button" id="blogSearchClear" class="search-clear-btn" title="Clear search">&times;</button>
        </div>

        <!-- Mobile Filter Button (Triggers Off-Canvas Drawer) -->
        <div class="mobile-filter-bar">
          <button type="button" class="mobile-filter-btn" id="blogFilterTriggerBtn" onclick="openFilterDrawer('blogFilterDrawer')">
            <i class="fa-solid fa-sliders"></i> Filter & Categories
          </button>
        </div>

        <!-- Desktop Category Filter Tabs (Dynamically Fetched from WordPress Database) -->
        <div class="filter-tabs">
          <button class="filter-tab-btn blog-filter-btn active" data-category="all">All Articles</button>
          <?php if (!empty($blog_categories) && !is_wp_error($blog_categories)) : ?>
            <?php foreach ($blog_categories as $cat) : 
              if ($cat->slug === 'uncategorized' && $cat->count == 0) continue;
            ?>
              <button class="filter-tab-btn blog-filter-btn" data-category="<?php echo esc_attr($cat->slug); ?>">
                <?php echo esc_html($cat->name); ?> (<?php echo intval($cat->count); ?>)
              </button>
            <?php endforeach; ?>
          <?php else: ?>
            <button class="filter-tab-btn blog-filter-btn" data-category="startup">Startup & Corporate</button>
            <button class="filter-tab-btn blog-filter-btn" data-category="trust">Trust & Estates</button>
            <button class="filter-tab-btn blog-filter-btn" data-category="tech">Cyber & AI Law</button>
            <button class="filter-tab-btn blog-filter-btn" data-category="labor">Labor & Employment</button>
            <button class="filter-tab-btn blog-filter-btn" data-category="ip">Intellectual Property</button>
            <button class="filter-tab-btn blog-filter-btn" data-category="litigation">Litigation & NI Act</button>
          <?php endif; ?>
        </div>

        <!-- Real-time Count Info -->
        <div id="blogCountInfo" class="search-results-info">Showing all articles</div>
      </div>

      <!-- Blog Grid Section (Dynamic WP Query with Pagination) -->
      <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 2rem;" id="blogGridContainer">
        <?php
        $paged = (get_query_var('paged')) ? get_query_var('paged') : ((get_query_var('page')) ? get_query_var('page') : 1);
        $blog_query = new WP_Query(array(
            'post_type'      => 'post',
            'posts_per_page' => 12,
            'paged'          => $paged,
            'post_status'    => 'publish',
            'orderby'        => 'date',
            'order'          => 'DESC'
        ));

        if ($blog_query->have_posts()) : while ($blog_query->have_posts()) : $blog_query->the_post();
            $post_categories = get_the_category();
            $cat_slugs = array();
            $cat_name = 'Legal Insight';
            if (!empty($post_categories)) {
                foreach ($post_categories as $c) {
                    $cat_slugs[] = $c->slug;
                }
                $cat_name = $post_categories[0]->name;
            }
            $cat_data_attr = !empty($cat_slugs) ? implode(' ', $cat_slugs) : 'all';

            $img_url = zca_legal_get_blog_image_url(get_the_ID());
        ?>
            <article class="blog-post-card" data-category="<?php echo esc_attr($cat_data_attr); ?>">
              <div class="blog-card-thumb">
                <img src="<?php echo esc_url($img_url); ?>" alt="<?php the_title_attribute(); ?>" onerror="this.onerror=null;this.src='<?php echo get_template_directory_uri(); ?>/assets/images/default-blog-fallback.jpg';">
                <span class="blog-card-badge"><?php echo esc_html($cat_name); ?></span>
              </div>
              <div class="blog-card-body">
                <div class="blog-card-meta">
                  <span><i class="fa-regular fa-calendar-days"></i> <?php echo get_the_date('M j, Y'); ?></span>
                  <span><i class="fa-regular fa-clock"></i> Legal Insight</span>
                </div>
                <h3 class="blog-card-title">
                  <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                </h3>
                <p class="blog-card-excerpt">
                  <?php echo esc_html(wp_trim_words(get_the_excerpt(), 20)); ?>
                </p>
                <div class="blog-card-footer">
                  <a href="<?php the_permalink(); ?>" class="blog-card-link">
                    Read Full Article <i class="fa-solid fa-arrow-right"></i>
                  </a>
                </div>
              </div>
            </article>
        <?php endwhile; wp_reset_postdata(); endif; ?>

        <!-- No Results Fallback Card -->
        <div id="blogNoResults" class="no-results-box">
          <i class="fa-solid fa-book-open"></i>
          <h3 style="font-size: 1.25rem; color: #091528; margin-bottom: 0.5rem;">No Articles Found</h3>
          <p style="font-size: 0.9rem; color: #64748b; margin-bottom: 1.25rem;">
            We couldn't find any legal blog articles matching your search query.
          </p>
          <button class="btn btn-sm btn-primary" onclick="resetBlogFilters()">
            <i class="fa-solid fa-rotate-left"></i> Reset Search & Filters
          </button>
        </div>

      </div>

      <!-- Pagination Controls (12 Articles Per Page) -->
      <?php if ($blog_query->max_num_pages > 1) : ?>
        <div class="pagination-wrapper">
          <?php
          echo paginate_links(array(
              'base'      => str_replace(999999999, '%#%', esc_url(get_pagenum_link(999999999))),
              'format'    => '?paged=%#%',
              'current'   => max(1, $paged),
              'total'     => $blog_query->max_num_pages,
              'prev_text' => '<i class="fa-solid fa-chevron-left"></i> Prev',
              'next_text' => 'Next <i class="fa-solid fa-chevron-right"></i>',
              'type'      => 'plain',
          ));
          ?>
        </div>
      <?php endif; ?>

    </div>
  </section>


  <!-- Mobile Off-Canvas Filter Drawer Component -->
  <div class="offcanvas-filter-backdrop" id="filterDrawerBackdrop"></div>
  
  <div class="offcanvas-filter-drawer" id="blogFilterDrawer">
    <div class="offcanvas-header">
      <div class="offcanvas-title"><i class="fa-solid fa-sliders"></i> Filter Legal Articles</div>
      <button type="button" class="offcanvas-close-btn" onclick="closeFilterDrawer('blogFilterDrawer')">&times;</button>
    </div>
    
    <div class="offcanvas-body">
      <!-- Search Inside Drawer -->
      <div class="offcanvas-section-title">Instant Keyword Search</div>
      <div style="margin-bottom: 1.5rem; position: relative;">
        <input 
          type="text" 
          id="blogMobileSearch" 
          class="form-control" 
          placeholder="Type to search (e.g. Startup, Trust...)" 
          style="border-radius: var(--radius-pill); padding-left: 1rem;"
        >
      </div>

      <!-- Real Categories in Drawer -->
      <div class="offcanvas-section-title">Select Blog Category</div>
      <div class="offcanvas-category-list">
        <div class="offcanvas-cat-item blog-offcanvas-cat active" data-category="all">
          <span>All Articles</span>
          <i class="fa-solid fa-check"></i>
        </div>
        <?php if (!empty($blog_categories) && !is_wp_error($blog_categories)) : ?>
          <?php foreach ($blog_categories as $cat) : 
            if ($cat->slug === 'uncategorized' && $cat->count == 0) continue;
          ?>
            <div class="offcanvas-cat-item blog-offcanvas-cat" data-category="<?php echo esc_attr($cat->slug); ?>">
              <span><?php echo esc_html($cat->name); ?></span>
              <span style="font-size: 0.75rem; background: rgba(0,0,0,0.06); padding: 2px 6px; border-radius: 4px;"><?php echo intval($cat->count); ?></span>
            </div>
          <?php endforeach; ?>
        <?php else: ?>
          <div class="offcanvas-cat-item blog-offcanvas-cat" data-category="startup"><span>Startup & Corporate</span></div>
          <div class="offcanvas-cat-item blog-offcanvas-cat" data-category="trust"><span>Trust & Estates</span></div>
          <div class="offcanvas-cat-item blog-offcanvas-cat" data-category="tech"><span>Cyber & AI Law</span></div>
          <div class="offcanvas-cat-item blog-offcanvas-cat" data-category="labor"><span>Labor & Employment</span></div>
          <div class="offcanvas-cat-item blog-offcanvas-cat" data-category="ip"><span>Intellectual Property</span></div>
          <div class="offcanvas-cat-item blog-offcanvas-cat" data-category="litigation"><span>Litigation & NI Act</span></div>
        <?php endif; ?>
      </div>
    </div>

    <div class="offcanvas-footer">
      <button type="button" class="btn btn-navy btn-sm" style="flex: 1;" onclick="resetBlogFilters()">
        <i class="fa-solid fa-rotate-left"></i> Reset
      </button>
      <button type="button" class="btn btn-primary btn-sm" style="flex: 1;" onclick="closeFilterDrawer('blogFilterDrawer')">
        Done
      </button>
    </div>
  </div>

<?php
get_footer();
