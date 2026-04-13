<?php
/**
 * Fancy Button Widget
 *
 * @package EEB
 * @version 1.4.1
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
				'default'     => esc_html__( 'Button', 'eweb-buttons' ),
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
			'button_icon',
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

		// ===== STYLE: Button =====
		$this->start_controls_section(
			'section_style_button',
			[
				'label' => esc_html__( 'Button Style', 'eweb-buttons' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'     => 'button_background',
				'label'    => esc_html__( 'Background', 'eweb-buttons' ),
				'types'    => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .cssbuttons-io-button',
			]
		);

		$this->add_control(
			'button_text_color',
			[
				'label'     => esc_html__( 'Text Color', 'eweb-buttons' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#FFFFFF',
				'selectors' => [ '{{WRAPPER}} .cssbuttons-io-button' => 'color: {{VALUE}};' ],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'button_typography',
				'selector' => '{{WRAPPER}} .cssbuttons-io-button',
			]
		);

		$this->add_control(
			'icon_bg_color',
			[
				'label'     => esc_html__( 'Icon Background Color', 'eweb-buttons' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#FFFFFF',
				'selectors' => [ '{{WRAPPER}} .cssbuttons-io-button .icon' => 'background-color: {{VALUE}};' ],
			]
		);

		$this->add_control(
			'icon_color',
			[
				'label'     => esc_html__( 'Icon Color', 'eweb-buttons' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#d87d62',
				'selectors' => [ '{{WRAPPER}} .cssbuttons-io-button .icon svg' => 'fill: {{VALUE}};' ],
			]
		);

		$this->end_controls_section();
	}

	protected function render(): void {
		$settings = $this->get_settings_for_display();

		$this->add_render_attribute( 'wrapper', 'class', 'cssbuttons-io-button' );

		// Soporte nativo para Popups y Enlaces Dinámicos.
		if ( ! empty( $settings['button_link']['url'] ) ) {
			$this->add_link_attributes( 'wrapper', $settings['button_link'] );
		} else {
			$this->add_render_attribute( 'wrapper', 'href', '#' );
		}

		$this->add_inline_editing_attributes( 'button_text', 'none' );
		?>
		<a <?php echo $this->get_render_attribute_string( 'wrapper' ); ?>>
			<span <?php echo $this->get_render_attribute_string( 'button_text' ); ?>>
				<?php echo esc_html( $settings['button_text'] ); ?>
			</span>
			<div class="icon">
				<?php Icons_Manager::render_icon( $settings['button_icon'], [ 'aria-hidden' => 'true' ] ); ?>
			</div>
		</a>
		<?php
	}
}
