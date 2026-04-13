<?php
/**
 * Fancy Button Widget
 *
 * @package EEB
 * @version 1.3.0
 */

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Background;
use Elementor\Icons_Manager;

defined( 'ABSPATH' ) || exit;

/**
 * EEB_Fancy_Button_Widget
 */
class EEB_Fancy_Button_Widget extends Widget_Base {

	public function get_name(): string {
		return 'eweb_fancy_button';
	}

	public function get_title(): string {
		return esc_html__( 'EWEB Fancy Button', 'eweb-buttons' );
	}

	public function get_icon(): string {
		return 'eicon-button';
	}

	public function get_categories(): array {
		return [ 'eweb-agency' ];
	}

	public function get_style_depends(): array {
		return [ 'widget-fancy-button' ];
	}

	protected function register_controls(): void {
		// ===== CONTENT =====
		$this->start_controls_section(
			'content_section',
			[
				'label' => esc_html__( 'Content', 'eweb-buttons' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'button_text',
			[
				'label'       => esc_html__( 'Button Text', 'eweb-buttons' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => esc_html__( 'Get started', 'eweb-buttons' ),
				'placeholder' => esc_html__( 'Escribe el texto…', 'eweb-buttons' ),
				'dynamic'     => [ 'active' => true ],
			]
		);

		$this->add_control(
			'button_link',
			[
				'label'       => esc_html__( 'Link', 'eweb-buttons' ),
				'type'        => Controls_Manager::URL,
				'placeholder' => 'https://tu-sitio.com',
				'default'     => [ 'url' => '#' ],
				'dynamic'     => [ 'active' => true ],
			]
		);

		$this->add_control(
			'icon',
			[
				'label'   => esc_html__( 'Icon', 'eweb-buttons' ),
				'type'    => Controls_Manager::ICONS,
				'default' => [
					'value'   => 'fas fa-arrow-right',
					'library' => 'fa-solid',
				],
			]
		);

		$this->end_controls_section();

		// ===== STYLE: Background =====
		$this->start_controls_section(
			'section_style_background',
			[
				'label' => esc_html__( 'Background', 'eweb-buttons' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'     => 'button_background',
				'label'    => esc_html__( 'Button Background', 'eweb-buttons' ),
				'types'    => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .cssbuttons-io-button',
			]
		);

		$this->end_controls_section();

		// ===== STYLE: Text & Icon =====
		$this->start_controls_section(
			'section_style_typography',
			[
				'label' => esc_html__( 'Text & Icon', 'eweb-buttons' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'text_color',
			[
				'label'     => esc_html__( 'Text Color', 'eweb-buttons' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#FFFFFF',
				'selectors' => [ '{{WRAPPER}} .cssbuttons-io-button' => 'color: {{VALUE}};' ],
			]
		);

		$this->add_control(
			'icon_bg_color',
			[
				'label'     => esc_html__( 'Icon Bubble Background', 'eweb-buttons' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#FFFFFF',
				'selectors' => [ '{{WRAPPER}} .cssbuttons-io-button .icon' => 'background-color: {{VALUE}};' ],
			]
		);

		$this->add_control(
			'icon_svg_color',
			[
				'label'     => esc_html__( 'Icon SVG Color', 'eweb-buttons' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#B721FF',
				'selectors' => [ '{{WRAPPER}} .cssbuttons-io-button .icon svg' => 'color: {{VALUE}}; fill: {{VALUE}};' ],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'typography',
				'selector' => '{{WRAPPER}} .cssbuttons-io-button',
			]
		);

		$this->end_controls_section();
	}

	protected function render(): void {
		$settings = $this->get_settings_for_display();
		$this->add_render_attribute( 'wrapper', 'class', 'cssbuttons-io-button' );

		$bg_mode = $settings['button_background_background'] ?? '';

		if ( empty( $bg_mode ) ) {
			$this->add_render_attribute( 'wrapper', 'class', 'feb-default-gradient' );
		} elseif ( 'classic' === $bg_mode ) {
			$this->add_render_attribute( 'wrapper', 'class', 'feb-bg-classic' );
		} elseif ( 'gradient' === $bg_mode ) {
			$this->add_render_attribute( 'wrapper', 'class', 'feb-bg-gradient' );
		}

		if ( ! empty( $settings['button_link']['url'] ) ) {
			$this->add_render_attribute( 'wrapper', 'href', esc_url( $settings['button_link']['url'] ) );
			if ( ! empty( $settings['button_link']['is_external'] ) ) {
				$this->add_render_attribute( 'wrapper', 'target', '_blank' );
			}
			if ( ! empty( $settings['button_link']['nofollow'] ) ) {
				$this->add_render_attribute( 'wrapper', 'rel', 'nofollow' );
			}
		} else {
			$this->add_render_attribute( 'wrapper', 'href', '#' );
		}
		?>
		<a <?php echo $this->get_render_attribute_string( 'wrapper' ); ?>>
			<span class="feb-text"><?php echo esc_html( $settings['button_text'] ); ?></span>
			<span class="icon" aria-hidden="true">
				<?php Icons_Manager::render_icon( $settings['icon'], [ 'aria-hidden' => 'true' ] ); ?>
			</span>
		</a>
		<?php
	}
}
