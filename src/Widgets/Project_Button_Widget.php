<?php
/**
 * Project Button Widget
 *
 * @package EEB
 * @version 1.3.7
 */

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Background;
use Elementor\Icons_Manager;
use Elementor\Group_Control_Box_Shadow;

defined( 'ABSPATH' ) || exit;

/**
 * EEB_Project_Button_Widget
 */
class EEB_Project_Button_Widget extends Widget_Base {

	public function get_name(): string {
		return 'eweb_project_button';
	}

	public function get_title(): string {
		return esc_html__( 'EWEB Project Button', 'eweb-buttons' );
	}

	public function get_icon(): string {
		return 'eicon-button';
	}

	public function get_categories(): array {
		return [ 'general' ];
	}

	public function get_style_depends(): array {
		return [ 'widget-project-button' ];
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
				'default'     => esc_html__( 'Start a Project', 'eweb-buttons' ),
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
			'icon_normal',
			[
				'label'   => esc_html__( 'Normal Icon', 'eweb-buttons' ),
				'type'    => Controls_Manager::ICONS,
				'default' => [
					'value'   => 'fas fa-arrow-right',
					'library' => 'fa-solid',
				],
			]
		);

		$this->add_control(
			'icon_hover',
			[
				'label'   => esc_html__( 'Hover Icon', 'eweb-buttons' ),
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

		$this->start_controls_tabs( 'tabs_button_style' );

		$this->start_controls_tab(
			'tab_button_normal',
			[
				'label' => esc_html__( 'Normal', 'eweb-buttons' ),
			]
		);

		$this->add_control(
			'button_bg_color',
			[
				'label'     => esc_html__( 'Background Color', 'eweb-buttons' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#d87d62',
				'selectors' => [ '{{WRAPPER}} .eweb-project-button' => 'background-color: {{VALUE}};' ],
			]
		);

		$this->add_control(
			'button_text_color',
			[
				'label'     => esc_html__( 'Text Color', 'eweb-buttons' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#FFFFFF',
				'selectors' => [ '{{WRAPPER}} .eweb-project-button' => 'color: {{VALUE}};' ],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'button_box_shadow',
				'selector' => '{{WRAPPER}} .eweb-project-button',
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_button_hover',
			[
				'label' => esc_html__( 'Hover', 'eweb-buttons' ),
			]
		);

		$this->add_control(
			'button_bg_color_hover',
			[
				'label'     => esc_html__( 'Background Color (Hover)', 'eweb-buttons' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#d87d62',
				'selectors' => [ '{{WRAPPER}} .eweb-project-button:hover' => 'background-color: {{VALUE}};' ],
			]
		);

		$this->add_control(
			'button_text_color_hover',
			[
				'label'     => esc_html__( 'Text Color (Hover)', 'eweb-buttons' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#FFFFFF',
				'selectors' => [ '{{WRAPPER}} .eweb-project-button:hover' => 'color: {{VALUE}};' ],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'button_box_shadow_hover',
				'selector' => '{{WRAPPER}} .eweb-project-button:hover',
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_responsive_control(
			'button_padding',
			[
				'label'      => esc_html__( 'Padding', 'eweb-buttons' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'default'    => [
					'top'      => '6',
					'right'    => '6',
					'bottom'   => '6',
					'left'     => '24',
					'unit'     => 'px',
					'isLinked' => false,
				],
				'selectors'  => [ '{{WRAPPER}} .eweb-project-button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};' ],
			]
		);

		$this->add_control(
			'button_border_radius',
			[
				'label'      => esc_html__( 'Border Radius', 'eweb-buttons' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'default'    => [
					'unit' => 'px',
					'size' => 50,
				],
				'selectors'  => [ '{{WRAPPER}} .eweb-project-button' => 'border-radius: {{SIZE}}{{UNIT}};' ],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'button_typography',
				'selector' => '{{WRAPPER}} .eweb-project-button',
			]
		);

		$this->end_controls_section();

		// ===== STYLE: Icon Bubble =====
		$this->start_controls_section(
			'section_style_icon',
			[
				'label' => esc_html__( 'Icon Bubble Style', 'eweb-buttons' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'bubble_bg_color',
			[
				'label'     => esc_html__( 'Bubble Background', 'eweb-buttons' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#FFFFFF',
				'selectors' => [ '{{WRAPPER}} .icon-circle' => 'background-color: {{VALUE}};' ],
			]
		);

		$this->add_control(
			'icon_color',
			[
				'label'     => esc_html__( 'Icon Color', 'eweb-buttons' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#d87d62',
				'selectors' => [ '{{WRAPPER}} .icon-circle i, {{WRAPPER}} .icon-circle svg' => 'color: {{VALUE}}; fill: {{VALUE}};' ],
			]
		);

		$this->add_responsive_control(
			'bubble_size',
			[
				'label'      => esc_html__( 'Bubble Size', 'eweb-buttons' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range'      => [
					'px' => [ 'min' => 20, 'max' => 100 ],
				],
				'default'    => [ 'size' => 44 ],
				'selectors'  => [ '{{WRAPPER}} .icon-circle' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};' ],
			]
		);

		$this->add_responsive_control(
			'icon_size',
			[
				'label'      => esc_html__( 'Icon Size', 'eweb-buttons' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range'      => [
					'px' => [ 'min' => 10, 'max' => 60 ],
				],
				'default'    => [ 'size' => 22 ],
				'selectors'  => [ '{{WRAPPER}} .icon-circle i, {{WRAPPER}} .icon-circle svg' => 'font-size: {{SIZE}}{{UNIT}}; width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};' ],
			]
		);

		$this->add_control(
			'icon_animation_heading',
			[
				'label'     => esc_html__( 'Icon Animation (Elite)', 'eweb-buttons' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'animation_spin',
			[
				'label'     => esc_html__( 'Rotation Spin (Degrees)', 'eweb-buttons' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => [
					'px' => [ 'min' => 0, 'max' => 360 ],
				],
				'default'   => [ 'size' => 90 ],
				'description' => esc_html__( 'How much the icon spins during transition.', 'eweb-buttons' ),
			]
		);

		$this->add_control(
			'hover_icon_angle',
			[
				'label'     => esc_html__( 'Hover Icon Final Angle', 'eweb-buttons' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => [
					'px' => [ 'min' => -360, 'max' => 360 ],
				],
				'default'   => [ 'size' => -45 ],
				'description' => esc_html__( 'Adjust this to tilt the icon (e.g. -45 for diagonal).', 'eweb-buttons' ),
				'selectors' => [ '{{WRAPPER}} .eweb-project-button:hover .icon-diagonal' => 'transform: rotate({{SIZE}}deg);' ],
			]
		);

		$this->end_controls_section();
	}

	protected function render(): void {
		$settings = $this->get_settings_for_display();
		$this->add_render_attribute( 'button', 'class', 'eweb-project-button' );

		// Calcular el ángulo de entrada del icono de hover basado en el spin.
		// Si el ángulo final es -45 y el spin es 90, empieza en -135.
		$spin = $settings['animation_spin']['size'] ?? 90;
		$final_angle = $settings['hover_icon_angle']['size'] ?? -45;
		$start_angle_hover = $final_angle - $spin;
		$exit_angle_normal = $spin;

		$this->add_inline_editing_attributes( 'button_text', 'none' );
		?>
		<style>
			{{WRAPPER}} .icon-straight { transform: rotate(0deg); }
			{{WRAPPER}} .eweb-project-button:hover .icon-straight { transform: rotate(<?php echo esc_attr( $exit_angle_normal ); ?>deg); }
			{{WRAPPER}} .icon-diagonal { transform: rotate(<?php echo esc_attr( $start_angle_hover ); ?>deg); }
		</style>

		<a <?php echo $this->get_render_attribute_string( 'button' ); ?>>
			<span class="btn-text"><?php echo esc_html( $settings['button_text'] ); ?></span>
			<span class="icon-circle" aria-hidden="true">
				<span class="icon-wrapper icon-straight">
					<?php Icons_Manager::render_icon( $settings['icon_normal'], [ 'aria-hidden' => 'true' ] ); ?>
				</span>
				<span class="icon-wrapper icon-diagonal">
					<?php Icons_Manager::render_icon( $settings['icon_hover'], [ 'aria-hidden' => 'true' ] ); ?>
				</span>
			</span>
		</a>
		<?php
	}
}
