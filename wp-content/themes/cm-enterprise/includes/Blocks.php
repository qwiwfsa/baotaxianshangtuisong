<?php

namespace Codemanas\CMEnterprise;

use DOMDocument;
use DOMXPath;

class Blocks {
	private static ?Blocks $instance = null;

	public static function get_instance(): ?Blocks {
		return is_null( self::$instance ) ? self::$instance = new self()
			: self::$instance;
	}

	private function __construct() {
		add_action( 'init', [ $this, 'register_block_styles' ] );
	}

	public function register_block_styles(): void {
		register_block_style(
			'core/button',
			array(
				'name'  => 'cm-enterprise-button-primary',
				'label' => __( 'Button Primary', 'cm-enterprise' ),
			)
		);
		register_block_style(
			'core/button',
			array(
				'name'  => 'cm-enterprise-button-primary-with-arrow',
				'label' => __( 'Button Primary With Arrow',
					'cm-enterprise' ),
			)
		);
		register_block_style(
			'core/button',
			array(
				'name'  => 'cm-enterprise-white-button',
				'label' => __( 'White Button', 'cm-enterprise' ),
			)
		);
		register_block_style(
			'core/button',
			array(
				'name'  => 'cm-enterprise-white-button-with-arrow',
				'label' => __( 'White Button With Arrow',
					'cm-enterprise' ),
			)
		);
		register_block_style(
			'core/list',
			array(
				'name'         => 'cm-enterprise-list-with-arrow',
				'label'        => __( 'Arrow Lists', 'cm-enterprise' ),
				'inline_style' => "
				.is-style-cm-enterprise-list-with-arrow  li{
					position: relative;
				}
				.is-style-cm-enterprise-list-with-arrow  li:before {
					content: '';
					width: 16px;
                    height: 16px;
					background: var(--wp--preset--color--light-color, currentColor);
					clip-path: path('M3.99993 8.01871C3.99993 8.21762 4.08852 8.40839 4.24623 8.54904C4.40393 8.68969 4.61782 8.76871 4.84084 8.76871H10.3797L8.17087 10.7387C8.02233 10.8809 7.94147 11.0689 7.94531 11.2632C7.94915 11.4575 8.03741 11.6429 8.19148 11.7803C8.34555 11.9177 8.55341 11.9965 8.77126 11.9999C8.98912 12.0033 9.19996 11.9312 9.35937 11.7987L13.0033 8.54871C13.1608 8.40808 13.2493 8.21746 13.2493 8.01871C13.2493 7.81996 13.1608 7.62933 13.0033 7.48871L9.35937 4.23871C9.28238 4.16502 9.18954 4.10592 9.08639 4.06493C8.98324 4.02394 8.87189 4.00189 8.75898 4.00012C8.64607 3.99834 8.53391 4.01686 8.4292 4.05459C8.3245 4.09231 8.22938 4.14845 8.14953 4.21967C8.06967 4.29089 8.00672 4.37572 7.96443 4.46911C7.92214 4.5625 7.90137 4.66253 7.90336 4.76323C7.90535 4.86393 7.93006 4.96325 7.97603 5.05525C8.02199 5.14725 8.08825 5.23005 8.17087 5.29871L10.3797 7.26871H4.84084C4.37666 7.26871 3.99993 7.60471 3.99993 8.01871Z');
					display: block;
					margin-right: 10px;
					z-index: 1;
				}
				.is-style-cm-enterprise-list-with-arrow  li:after {
					content: '';
				    position: absolute;
				    left: -1px;
				    background: var(--wp--preset--color--accent-color, currentColor);
				    height: 20px;
				    width: 20px;
				    border-radius: 100px!important;
				    z-index: 0;
				}
				
				.is-style-cm-enterprise-list-with-arrow .wp-block-list-item:before {
				    position: absolute;
				    left: -27px;
				    top: 50%;
				    transform: translateY(-50%);
				}
				.is-style-cm-enterprise-list-with-arrow .wp-block-list-item:after {
				    position: absolute;
				    left: -28px!important;
				    top: 50%!important;
				    transform: translateY(-50%)!important;
				}",
			)
		);
		register_block_style(
			'core/cover',
			array(
				'name'  => 'cm-enterprise-image-hover-effect',
				'label' => __( 'Hover Effects', 'cm-enterprise' ),
			)
		);
		register_block_style(
			'core/group',
			array(
				'name'  => 'cm-enterprise-box-shadow-light',
				'label' => __( 'Box Shadow Light', 'cm-enterprise' ),
			)
		);
	}


}