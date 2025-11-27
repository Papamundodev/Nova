<?php
/**
 * Template Name: Design System
 */
get_header();
$object = get_queried_object();
$theme_template_name = basename(__FILE__, ".php");
$featured_image = get_the_post_thumbnail_url($object->ID);
$content = wpautop($object->post_content);
$logo_landscape = get_field('logo_landscape', 'option');
$logo_square = get_field('logo_square', 'option');
$logo = get_field('logo', 'option');
?>


<main id="main-<?=$theme_template_name?>" class="main">


<section class="design-system">
    <div class="container">
        <h1 class="title-gradient">Design System</h1>
        <div class="wrapper  table-component">
            <div class="logo-system">
                <div class="design-system-header ">
                    <h2 class="">Logos</h2>
                </div>
                <div class="">
                    <div class="site-logo logo">
                        <a class="" href="<?=home_url();?>" rel="home" aria-label="Page d'accueil">
                            <img src="<?=$logo_landscape['sizes']['large'];?>" alt="logo du site">
                        </a>
                        <a class="" href="<?=home_url();?>" rel="home" aria-label="Page d'accueil">
                            <img src="<?=$logo['sizes']['large'];?>" alt="logo du site">
                        </a>
                        <a class="" href="<?=home_url();?>" rel="home" aria-label="Page d'accueil">
                            <img src="<?=$logo_square['sizes']['large'];?>" alt="logo du site">
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="wrapper  table-component">
            <div class="font-system ">
                <div class="design-system-header ">
                    <h2 class="">Font</h2>
                </div>
                <div class="grid-table">
                    <p class="">fs-xs</p>
                    <div class="flex-column-center">
                        <p class="fs-xs">Lorem ipsum dolor.</p>
                        <code class="fs-xs">clamp(0.8125rem, 0.90625rem + 0.09375vi, 1rem)</code>
                    </div>
                </div>
                <div class="grid-table">
                    <p class="">fs-default</p>
                    <div class="flex-column-center">
                        <p class="fs-default">Lorem ipsum dolor.</p>
                        <code class="fs-xs">clamp(1rem, 1.125rem + 0.125vi, 1.25rem)</code>
                    </div>
                </div>
                <div class="grid-table">
                    <p class="">fs-sm</p>
                    <div class="flex-column-center">
                        <p class="fs-sm">Lorem ipsum dolor.</p>
                        <code class="fs-xs">clamp(1.25rem, 1.4375rem + 0.1875vi, 1.5rem)</code>
                    </div>
                </div>
                <div class="grid-table">
                    <p class="">fs-md</p>
                    <div class="flex-column-center">
                        <p class="fs-md">Lorem ipsum dolor.</p>
                        <code class="fs-xs">clamp(2rem, 2.0625rem + 0.0625vi, 2.125rem)</code>
                    </div>
                </div>
                <div class="grid-table">
                    <p class="">fs-lg</p>  
                    <div class="flex-column-center">
                        <p class="fs-lg">Lorem ipsum dolor.</p>
                        <code class="fs-xs">clamp(3rem, 3.25rem + 0.25vi, 3.5rem)</code>
                    </div>
                </div>
                <div class="grid-table">
                    <p class="">fs-xl</p>
                    <div class="flex-column-center">
                        <p class="fs-xl">Lorem ipsum dolor.</p>
                        <code class="fs-xs">clamp(5rem, 5.5rem + 0.5vi, 6rem)</code>
                    </div>
                </div>
            </div>
        </div>

        

        <div class="wrapper  table-component">
            <div class="font-family-system ">
                <div class="design-system-header ">
                    <h2 class="">Font Family</h2>
                </div>
                <div class="grid-table">
                    <p class="">Coda</p>
                    <p class="text-font fs-lg">Lorem ipsum DOLOR.</p>
                </div>
                <div class="grid-table">
                    <p class="">Russo one</p>
                    <p class="heading-font fs-lg">Lorem ipsum DOLOR.</p>
                </div>
            </div>
        </div>
        <div class="wrapper  table-component font-weight-system">
            <div class="font-family-system ">
                <div class="design-system-header ">
                    <h2 class="">Font Weight</h2>
                </div>
                <div class="grid-table">
                    <p class="">Text font weight</p>
                    <div class="">
                        <p class="weight-400 text-font">Weight 400 - The quick brown fox jumps over the lazy dog</p>
                        <p class="weight-400 heading-font">Weight 400 - The quick brown fox jumps over the lazy dog</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="wrapper  table-component color-text-system">
            <div class="design-system-header ">
                <h2 class="">Color</h2>
            </div>
            <div class="grid-table">
                <div class="gap-xs element-ratio-calculating">
                    <div class="flex-column-center">
                        <p class="default-color">default-color</p>
                        <div class="text-color default-color">
                            <p class="color-computed"></p>
                        </div>
                    </div>
                </div>
                <p class="default-color fs-lg">Lorem ipsum dolor.</p>
            </div>
            <div class="grid-table">
                <div class="gap-xs element-ratio-calculating">
                    <div class="flex-column-center">
                        <p class="gray-color">gray-color</p>
                        <div class="text-color gray-color">
                            <p class="color-computed"></p>
                        </div>
                    </div>
                </div>
                <p class="gray-color fs-lg">Lorem ipsum dolor.</p>
            </div>
            <div class="grid-table">
                <div class="gap-xs element-ratio-calculating">
                    <div class="flex-column-center">
                        <p class="primary-color">primary-color</p>
                        <div class="text-color primary-color">
                            <p class="color-computed"></p>
                        </div>
                    </div>
                </div>
                <p class="primary-color fs-lg">Lorem ipsum dolor.</p>
            </div>
            <div class="grid-table">
                <div class="gap-xs element-ratio-calculating">
                    <div class="flex-column-center">
                        <p class="accent-color">accent-color</p>
                        <div class="text-color accent-color">
                            <p class="color-computed"></p>
                        </div>
                    </div>
                </div>
                <p class="accent-color fs-lg">Lorem ipsum dolor.</p>
            </div>
            <div class="grid-table">
                <div class="gap-xs element-ratio-calculating">
                    <div class="flex-column-center">
                        <p class="secondary-color">secondary-color</p>
                        <div class="text-color secondary-color">
                            <p class="color-computed"></p>
                        </div>
                    </div>
                </div>
                <p class="secondary-color fs-lg">Lorem ipsum dolor.</p>
            </div>
        </div>

        <div class="wrapper  background-color-system ">
            <div class="design-system-header ">
                <h2 class="">Background Color</h2>
            </div>
            <div class="flex-auto">
                <div>
                    <div class="bg-background-color element-ratio-calculating">
                        <div class="flex-column-center gap-xs">
                            <p class="fs-sm">background-color</p>
                            <div class="bg-color-computed"></div>
                        </div>
                        <p class="default-color text-color">Lorem ipsum dolor. <span class="ratio"></span></p>
                        <p class="gray-color text-color">Lorem ipsum dolor. <span class="ratio"></span></p>
                        <p class="primary-color text-color">Lorem ipsum dolor. <span class="ratio"></span></p>
                        <p class="accent-color text-color">Lorem ipsum dolor. <span class="ratio"></span></p>
                        <p class="secondary-color text-color">Lorem ipsum dolor. <span class="ratio"></span></p> 
                        <p class="contrast-color text-color">Lorem ipsum dolor. <span class="ratio"></span></p>
                    </div>
                </div>
                <div>
                    <div class="bg-primary-color element-ratio-calculating">
                        <div class="flex-column-center gap-xs">
                            <p class="fs-sm">primary-color</p>
                            <div class="bg-color-computed"></div>
                        </div>  
                        <p class="default-color text-color">Lorem ipsum dolor. <span class="ratio"></span></p>
                        <p class="gray-color text-color">Lorem ipsum dolor. <span class="ratio"></span></p>
                        <p class="primary-color text-color">Lorem ipsum dolor. <span class="ratio"></span></p>
                        <p class="accent-color text-color">Lorem ipsum dolor. <span class="ratio"></span></p>
                        <p class="secondary-color text-color">Lorem ipsum dolor. <span class="ratio"></span></p>
                        <p class="contrast-color text-color">Lorem ipsum dolor. <span class="ratio"></span></p>
                    </div>
                </div>
                <div>
                    <div class="bg-secondary-color element-ratio-calculating">
                        <div class="flex-column-center gap-xs">
                            <p class="fs-sm">secondary-color</p>
                            <div class="bg-color-computed"></div>
                        </div>
                        <p class="default-color text-color">Lorem ipsum dolor. <span class="ratio"></span></p>
                        <p class="gray-color text-color">Lorem ipsum dolor. <span class="ratio"></span></p>
                        <p class="primary-color text-color">Lorem ipsum dolor. <span class="ratio"></span></p>
                        <p class="accent-color text-color">Lorem ipsum dolor. <span class="ratio"></span></p>
                        <p class="secondary-color text-color">Lorem ipsum dolor. <span class="ratio"></span></p>
                        <p class="contrast-color text-color">Lorem ipsum dolor. <span class="ratio"></span></p>
                    </div>
                </div>
                <div>
                    <div class="bg-blue-color element-ratio-calculating">
                        <div class="flex-column-center gap-xs">
                            <p class="fs-sm">blue-color</p>
                            <div class="bg-color-computed"></div>
                        </div>
                        <p class="default-color text-color">Lorem ipsum dolor. <span class="ratio"></span></p>
                        <p class="gray-color text-color">Lorem ipsum dolor. <span class="ratio"></span></p>
                        <p class="primary-color text-color">Lorem ipsum dolor. <span class="ratio"></span></p>
                        <p class="accent-color text-color">Lorem ipsum dolor. <span class="ratio"></span></p>
                        <p class="secondary-color text-color">Lorem ipsum dolor. <span class="ratio"></span></p>
                        <p class="contrast-color text-color">Lorem ipsum dolor. <span class="ratio"></span></p>
                    </div>
                </div>
                <div>
                    <div class="bg-green-color element-ratio-calculating">
                        <div class="flex-column-center gap-xs">
                            <p class="fs-sm">green-color</p>
                            <div class="bg-color-computed"></div>
                        </div>
                        <p class="default-color text-color">Lorem ipsum dolor. <span class="ratio"></span></p>
                        <p class="gray-color text-color">Lorem ipsum dolor. <span class="ratio"></span></p>
                        <p class="primary-color text-color">Lorem ipsum dolor. <span class="ratio"></span></p>
                        <p class="accent-color text-color">Lorem ipsum dolor. <span class="ratio"></span></p>
                        <p class="secondary-color text-color">Lorem ipsum dolor. <span class="ratio"></span></p>
                        <p class="contrast-color text-color">Lorem ipsum dolor. <span class="ratio"></span></p>
                    </div>
                </div>
                <div>
                    <div class="bg-purple-color element-ratio-calculating">
                        <div class="flex-column-center gap-xs">
                            <p class="fs-sm">purple-color-background</p>
                            <div class="bg-color-computed"></div>
                        </div>
                        <p class="default-color text-color">Lorem ipsum dolor. <span class="ratio"></span></p>
                        <p class="gray-color text-color">Lorem ipsum dolor. <span class="ratio"></span></p>
                        <p class="primary-color text-color">Lorem ipsum dolor. <span class="ratio"></span></p>
                        <p class="accent-color text-color">Lorem ipsum dolor. <span class="ratio"></span></p>
                        <p class="secondary-color text-color">Lorem ipsum dolor. <span class="ratio"></span></p>
                        <p class="contrast-color text-color">Lorem ipsum dolor. <span class="ratio"></span></p>
                    </div>
                </div>
                <div>
                    <div class="bg-orange-color element-ratio-calculating">
                        <div class="flex-column-center gap-xs">
                            <p class="fs-sm">orange-color</p>
                            <div class="bg-color-computed"></div>
                        </div>
                        <p class="default-color text-color">Lorem ipsum dolor. <span class="ratio"></span></p>
                        <p class="gray-color text-color">Lorem ipsum dolor. <span class="ratio"></span></p>
                        <p class="primary-color text-color">Lorem ipsum dolor. <span class="ratio"></span></p>
                        <p class="accent-color text-color">Lorem ipsum dolor. <span class="ratio"></span></p>
                        <p class="secondary-color text-color">Lorem ipsum dolor. <span class="ratio"></span></p>
                        <p class="contrast-color text-color">Lorem ipsum dolor. <span class="ratio"></span></p>
                    </div>
                </div>
                <div>
                    <div class="bg-dark-blue-color element-ratio-calculating">
                       <div class="flex-column-center gap-xs">
                            <p class="fs-sm">dark-blue-color</p>
                            <div class="bg-color-computed"></div>
                        </div>
                        <p class="default-color text-color">Lorem ipsum dolor. <span class="ratio"></span></p>
                        <p class="gray-color text-color">Lorem ipsum dolor. <span class="ratio"></span></p>
                        <p class="primary-color text-color">Lorem ipsum dolor. <span class="ratio"></span></p>
                        <p class="accent-color text-color">Lorem ipsum dolor. <span class="ratio"></span></p>
                        <p class="secondary-color text-color">Lorem ipsum dolor. <span class="ratio"></span></p>
                        <p class="contrast-color text-color">Lorem ipsum dolor. <span class="ratio"></span></p>
                    </div>
                </div>
            </div>
        </div>

        <div class="wrapper  button-system table-component ">
            <div class="">
                <h2 class="">Buttons</h2>
            </div>
            <div class="flex-auto">
                <div class="button-wrapper">
                    <div class="button-container button-background-primary button-background-animation">
                        <a href="<?=home_url() . '/contact';?>" class="btn">Button primary</a>
                        <span class="hover-bg"></span>
                    </div>
                </div>
                <div class="button-wrapper">
                    <div class="button-container button-background-secondary-icon">
                        <button class=" btn">Button secondary
                            <?php echo file_get_contents(get_template_directory() . '/assets/images/arrow-up-right-bold.svg'); ?>
                        </button>
                    </div>
                </div> 
                <div class="button-wrapper">
                    <div class="button-container button-background-secondary-icon button-wave-animation">
                        <button class="btn" data-name="Button background animation">
                        <span class="button-text">Button background animation</span>
                        <?php echo file_get_contents(get_template_directory() . '/assets/images/arrow-up-right-bold.svg'); ?>
                        </button>
                    </div>
                </div> 
            </div>
        </div>

         <div class="wrapper text-system table-component">
            <div class="">
                <h2 class="">Paragraphes</h2>
            </div>
            <div class="flex-auto">
                <div class="">
                    <div class="grid-table">
                        <p class="">Regular</p>
                        <p>
                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Quisquam, quos.
                            Lorem <span class="text-bold">ipsum dolor</span> sit amet consectetur adipisicing elit. Quisquam, quos.
                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Quisquam, quos.
                        </p>
                    </div>
                    <div class="grid-table">
                        <p class="">Bold </p>
                        <p class="text-bold">
                            Text bold - Lorem ipsum dolor sit amet consectetur adipisicing elit. Quisquam, quos.
                        </p>
                    </div>
                    <div class="grid-table">
                        <p class="">Lead</p>
                        <p class="text-lead">
                            Text paragraph lead - Lorem ipsum dolor sit amet consectetur adipisicing elit. Quisquam, quos.
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <div class="wrapper text-system table-component">
            <div class="">
                <h2 class="">Titles</h2>
            </div>
            <div class="flex-auto">
                <div class="grid-table">
                    <p class="">~100px</p>
                    <h3 class="title-gradient">Digital & Communication</h3>
                </div>
                <div class="grid-table">
                    <p class="">~80px</p>
                    <h3 class="heading-big-1">Branding Design</h3>
                </div>
                <div class="grid-table">
                    <p class="">~60px</p>
                    <h3 class="heading-big-2">Travaillons ensemble</h3>
                </div>
                <div class="grid-table">
                    <p class="">~56px</p>
                    <h3 class="heading-large-1">Un collectif de freelances experts</h3>
                </div>
                <div class="grid-table">
                    <p class="">~44px</p>
                    <h3 class="heading-medium-large-1">Qui sommes-nous ?</h3>
                </div>
                <div class="grid-table">
                    <p class="">~34px</p>
                    <h3 class="heading-medium-1">Projet 2</h3>  
                </div>
                <div class="grid-table">
                    <p class="">~24px</p>
                    <h3 class="heading-small-1">Branding Design</h3>
                </div>
            </div>
        </div>

        <div class="wrapper  border-radius-system">
            <div class="design-system-header ">
                <h2 class="">Border Radius</h2>
            </div>
            <div class=" flex-auto">
                <div class="">
                    <div class="">
                        <div class=""></div>
                    </div>
                </div>
                <div class="">
                    <div class="">
                        <div class=""></div>
                    </div>
                </div>
                <div class="">
                    <div class="">
                        <div class=""></div>
                    </div>
                </div>
                <div class="">
                    <div class="">
                        <div class=""></div>
                    </div>
                </div>
                <div class="">
                    <div class="">
                        <div class=""></div>
                    </div>
                </div>
                <div class="">
                    <div class="">
                        <div class=""></div>
                    </div>
                </div>
                <div class="">
                    <div class="">
                        <div class=""></div>
                    </div>
                </div>
                <div class="">
                    <div class="">
                        <div class=""></div>
                    </div>
                </div>
                <div class="">
                    <div class="">
                        <div class=""></div>
                    </div>
                </div>
                <div class="">
                    <div class="">
                        <div class=""></div>
                    </div>
                </div>
            </div>
        </div>




        <div class="wrapper  img-sizes-system">
            <div class="design-system-header ">
                <h2 class="">Img Sizes</h2>
            </div>
            <div class=" flex-auto">
                <div class="">
                    <div class="">
                        <div class=""></div>
                    </div>
                </div>
                <div class="">
                    <div class="">
                        <div class=""></div>
                    </div>
                </div>
                <div class="">
                    <div class="">
                        <div class=""></div>
                    </div>
                </div>
                <div class="">
                    <div class="">
                        <div class=""></div>
                    </div>
                </div>
                <div class="">
                    <div class="">
                        <div class=""></div>
                    </div>
                </div>
                <div class="">
                    <div class="">
                        <div class=""></div>
                    </div>
                </div>
                <div class="">
                    <div class="">
                        <div class=""></div>
                    </div>
                </div>
                <div class="">
                    <div class="">
                        <div class=""></div>
                    </div>
                </div>
                <div class="">
                    <div class="">
                        <div class=""></div>
                    </div>
                </div>
            </div>
        </div>




    </div>
</section>

</main>


<?php
get_footer();