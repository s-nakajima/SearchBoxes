<?php
/**
 * SearchBoxesController Test Case
 *
 * @author Jun Nishikawa <topaz2@m0n0m0n0.com>
 * @link http://www.netcommons.org NetCommons Project
 * @license http://www.netcommons.org/license.txt NetCommons License
 */

App::uses('SearchBoxesAppControllerTest', 'SearchBoxes.Test/Case/Controller');
App::uses('SearchBoxesController', 'SearchBoxes.Controller');

/**
 * Summary for SearchBoxesController Test Case
 */
class SearchBoxesControllerTest extends SearchBoxesAppControllerTest {

/**
 * Expect visitor can access view action
 *
 * @return void
 */
	public function testView() {
		$this->testAction(
			'/search_boxes/search_boxes/view/191',
			array(
				'method' => 'get',
			)
		);
		$this->assertTextEquals('view', $this->controller->view);
	}

/**
 * Expect admin user can access edit action
 *
 * @return void
 */
	public function testEditGet() {
		RolesControllerTest::login($this);

		$this->testAction(
			'/search_boxes/search_boxes/edit/191',
			array(
				'method' => 'get',
				'return' => 'contents'
			)
		);

		$this->assertTextEquals('edit', $this->controller->view);

		AuthGeneralControllerTest::logout($this);
	}

/**
 * Expect admin user can edit topic frame settings
 *
 * @return void
 */
	public function testEditPost() {
		RolesControllerTest::login($this);
		$this->testAction(
			'/search_boxes/search_boxes/edit/191',
			array(
				'method' => 'post',
				'data' => array(
					'SearchBox' => array(
						'id' => '1',
						'frame_key' => 'frame_191',
						'created_user' => '1',
						'modified_user' => '1',
						'is_advanced' => '1',
					),
					'Frame' => array(
						'key' => 'frame_191',
					),
					'SearchBoxTargetPlugin' => array(
						'plugin_key' => array(
							0 => 'announcements',
							1 => 'bbses',
							2 => 'blogs',
							3 => 'circular_notices',
							4 => 'questionnaires',
						),
					),
				),
				'return' => 'contents'
			)
		);
		$this->assertTextEquals('edit', $this->controller->view);

		AuthGeneralControllerTest::logout($this);
	}

/**
 * Expect admin user can edit topic frame settings
 *
 * @return void
 */
	public function testEditPostWithUnknownTopicFrameSetting() {
		RolesControllerTest::login($this);
		$this->setExpectedException('NotFoundException');

		$this->testAction(
			'/search_boxes/search_boxes/edit/1',
			array(
				'method' => 'post',
				'data' => array(
					'SearchBox' => array(
						'id' => '1',
						'frame_key' => 'frame_1',
						'created_user' => '1',
						'modified_user' => '1',
						'is_advanced' => '1',
					),
					'Frame' => array(
						'key' => 'frame_1',
					),
					'SearchBoxTargetPlugin' => array(
						'plugin_key' => array(
							0 => 'announcements',
							1 => 'bbses',
							2 => 'blogs',
							3 => 'circular_notices',
							4 => 'questionnaires',
						),
					),
				),
				'return' => 'contents'
			)
		);
		$this->assertTextEquals('edit', $this->controller->view);

		AuthGeneralControllerTest::logout($this);
	}

/**
 * Expect admin user can edit topic frame settings
 *
 * @return void
 */
	public function testEditPostWithInvalidFrameId() {
		RolesControllerTest::login($this);

		$this->testAction(
			'/search_boxes/search_boxes/edit/191',
			array(
				'method' => 'post',
				'data' => array(
					'SearchBox' => array(
						'id' => '1',
						'frame_key' => '',
						'created_user' => '1',
						'modified_user' => '1',
						'is_advanced' => '1',
					),
					'Frame' => array(
						'key' => '',
					),
					'SearchBoxTargetPlugin' => array(
						'plugin_key' => array(
							0 => 'announcements',
							1 => 'bbses',
							2 => 'blogs',
							3 => 'circular_notices',
							4 => 'questionnaires',
						),
					),
				),
				'return' => 'contents'
			)
		);
		$this->assertTextEquals('edit', $this->controller->view);

		AuthGeneralControllerTest::logout($this);
	}

/**
 * Expect admin user failes to edit topic frame settings with invalid searchbox target plugin key
 *
 * @return void
 */
	public function testEditPostWithInvalidSearchBoxTargetPluginKey() {
		RolesControllerTest::login($this);

		$this->testAction(
			'/search_boxes/search_boxes/edit/191',
			array(
				'method' => 'post',
				'data' => array(
					'SearchBox' => array(
						'id' => '1',
						'frame_key' => 'frame_191',
						'created_user' => '1',
						'modified_user' => '1',
						'is_advanced' => '1',
					),
					'Frame' => array(
						'key' => 'frame_191',
					),
					'SearchBoxTargetPlugin' => array(
						'plugin_key' => array(
							0 => 'invalid',
						),
					),
				),
				'return' => 'contents'
			)
		);
		$this->assertTextEquals('edit', $this->controller->view);

		AuthGeneralControllerTest::logout($this);
	}
}
