    <section aria-labelledby="section-projects-title" class="section-projects container">
        <?php $section_projet_title = get_field('section_projet_title', $object); ?>
        <h2 id="section-projects-title" class="section-title"><?= $section_projet_title; ?></h2>
        <div class="projects-container column-layout">
            <?php $projects = get_field('projects', "option"); ?>
            <?php foreach ($projects as $project) : ?>
                <div class="project card">
                    <div class="img-container">
                        <img src="<?= $project['gallery'][0]['url']; ?>" alt="<?= $project['gallery'][0]['alt']; ?>">
                    </div>
                    <div class="cat-container">
                        <?php foreach ($project['expertises'] as $expertise) : ?>
                            <?php
                            $color = get_field('color', $expertise);
                            $link = get_term_link($expertise);
                            ?>
                            <span class="expertise-number"><a class="<?= $color; ?>-color" href="<?= $link; ?>"><?= $expertise->name; ?></a></span>
                            <span class="separator">|</span>
                        <?php endforeach; ?>
                    </div>
                    <h3><?= $project['title']; ?></h3>
                    <div class="button-container button-background-secondary-icon button-wave-animation">
                        <button class="btn" data-name="<?= $project['text']; ?>">
                            <span class="button-text"><?= $project['text']; ?></span>
                            <?php echo file_get_contents(get_template_directory() . '/assets/images/arrow-up-right-bold.svg'); ?>
                        </button>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </section>