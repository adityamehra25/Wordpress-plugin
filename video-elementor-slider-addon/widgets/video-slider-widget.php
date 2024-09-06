<?php

class Multi_Video_Slider_Widget extends \Elementor\Widget_Base {
    
    public function get_name() {
        return 'multi_video_slider';
    }

    public function get_title() {
        return __('Multi Video Slider', 'multi-video-slider');
    }

    public function get_icon() {
        return 'eicon-play';
    }

    public function get_categories() {
        return ['basic'];
    }

    protected function _register_controls() {
        $this->start_controls_section(
            'content_section',
            [
                'label' => __('Content', 'multi-video-slider'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'videos',
            [
                'label' => __('Videos', 'multi-video-slider'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => [
                    [
                        'name' => 'video_type',
                        'label' => __('Video Type', 'multi-video-slider'),
                        'type' => \Elementor\Controls_Manager::SELECT,
                        'options' => [
                            'youtube' => __('YouTube', 'multi-video-slider'),
                            'self_hosted' => __('Self Hosted', 'multi-video-slider'),
                        ],
                        'default' => 'youtube',
                    ],
                    [
                        'name' => 'youtube_url',
                        'label' => __('YouTube URL', 'multi-video-slider'),
                        'type' => \Elementor\Controls_Manager::TEXT,
                        'condition' => [
                            'video_type' => 'youtube',
                        ],
                    ],
                    [
                        'name' => 'self_hosted_video',
                        'label' => __('Self Hosted Video', 'multi-video-slider'),
                        'type' => \Elementor\Controls_Manager::MEDIA,
                        'media_type' => 'video',
                        'condition' => [
                            'video_type' => 'self_hosted',
                        ],
                    ],
                    [
                        'name' => 'custom_thumbnail',
                        'label' => __('Custom Thumbnail', 'multi-video-slider'),
                        'type' => \Elementor\Controls_Manager::MEDIA,
                        'media_type' => 'image',
                    ],
                    [
                        'name' => 'custom_play_icon',
                        'label' => __('Custom Play Icon', 'multi-video-slider'),
                        'type' => \Elementor\Controls_Manager::MEDIA,
                        'media_type' => 'image',
                    ],
                ],
                'default' => [
                    [
                        'video_type' => 'youtube',
                        'youtube_url' => 'https://www.youtube.com/watch?v=dQw4w9WgXcQ',
                    ],
                ],
                'title_field' => '{{{ video_type }}}',
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        ?>
        <div class="multi-video-slider swiper-container">
            <div class="swiper-wrapper">
                <?php
                // Chunk the videos array into chunks of 3
                $chunks = array_chunk($settings['videos'], 3);
                foreach ($chunks as $chunk):
                ?>
                    <div class="swiper-slide">
                        <div class="slide-inner">
                            <?php foreach ($chunk as $video): ?>
                                <div class="video-wrapper">
                                    <?php if ($video['custom_thumbnail']['url']): ?>
                                        <img src="<?php echo $video['custom_thumbnail']['url']; ?>" alt="Video Thumbnail" class="video-thumbnail">
                                    <?php endif; ?>
                                    <div class="play-icon-wrapper">
                                        <img src="<?php echo $video['custom_play_icon']['url']; ?>" alt="Play Icon" class="play-icon">
                                    </div>
    
                                    <?php if ($video['video_type'] == 'youtube'): ?>
                                        <iframe class="video-iframe" src="https://www.youtube.com/embed/<?php echo $this->get_youtube_video_id($video['youtube_url']); ?>" frameborder="0" allowfullscreen></iframe>
                                    <?php elseif ($video['video_type'] == 'self_hosted'): ?>
                                        <video class="self-hosted-video" controls>
                                            <source src="<?php echo $video['self_hosted_video']['url']; ?>" type="video/mp4">
                                        </video>
                                    <?php endif; ?>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
            <!-- Add Pagination -->
            <div class="swiper-pagination"></div>
            <!-- Add Navigation if needed -->
            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
        </div>
        <?php
    }
        

    private function get_youtube_video_id($url) {
        parse_str(parse_url($url, PHP_URL_QUERY), $vars);
        return $vars['v'];
    }

}
