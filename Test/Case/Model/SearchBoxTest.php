<?php
/**
 * SearchBox Test Case
 *
 * @author   Jun Nishikawa <topaz2@m0n0m0n0.com>
 * @link     http://www.netcommons.org NetCommons Project
 * @license  http://www.netcommons.org/license.txt NetCommons License
 */

App::uses('SearchBoxAppModelTest', 'SearchBoxes.Test/Case/Model');
App::uses('SearchBox', 'Model');

/**
 * Summary for SearchBox Test Case
 */
class SearchBoxTest extends SearchBoxAppModelTest {

/**
 * Expect SearchBox->afterFrameSave() saves data w/ numeric frame_id
 *
 * @return void
 */
	public function testAfterFrameSave() {
		$expectCount = $this->SearchBox->find('count', ['recursive' => -1]) + 1;
		$this->SearchBox->afterFrameSave([
			'Frame' => [
				'key' => 'frame_191',
			],
		]);
		$this->assertEquals($expectCount, $this->SearchBox->find('count', ['recursive' => -1]));
	}

/**
 * Expect SearchBox->saveSettings() return validation errors with invalid request
 *
 * @return void
 */
	public function testSaveSearchBoxWithInvalidRequest() {
		$mock = $this->getMockForModel('SearchBoxes.SearchBox', ['validateSearchBox']);
		$mock->expects($this->any())
			->method('validateSearchBox')
			->will($this->returnValue(false));

		$ret = $this->SearchBox->afterFrameSave([
			'Frame' => [
				'key' => '',
			],
		]);
		$this->assertFalse($ret);
	}

/**
 * Expect SearchBox->saveSettings() return validation errors with invalid request
 *
 * @return void
 */
	public function testSaveSearchBoxWithInvalidSearchBox() {
		$ret = $this->SearchBox->saveSettings([
			'SearchBox' => [
				'id' => '1',
				'frame_key' => '',
				'created_user' => '1',
				'modified_user' => '1',
				'is_advanced' => '1',
			],
			'Frame' => [
				'key' => 'frame_191',
			],
		]);
		$this->assertFalse($ret);
	}

/**
 * Expect SearchBox->saveSettings() return validation errors with invalid request
 *
 * @return void
 */
	public function testSaveSearchBoxWithInvalidSearchBoxTargetPlugin() {
		$this->SearchBox->saveSettings([
			'SearchBox' => [
				'id' => '1',
				'frame_key' => 'frame_191',
				'created_user' => '1',
				'modified_user' => '1',
				'is_advanced' => '1',
			],
			'Frame' => [
				'key' => 'frame_191',
			],
			'SearchBoxTargetPlugin' => [
				'search_box_id' => null,
				'plugin_key' => [
					0 => 'announcements',
					1 => 'bbses',
					2 => 'blogs',
					3 => 'circular_notices',
					4 => 'questionnaires',
				],
			],
		]);
		$this->assertEmpty($this->SearchBox->validationErrors);
	}

/**
 * Expect SearchBox->afterFrameSave() fail on search box save
 * e.g.) connection error
 *
 * @return void
 */
	public function testAfterFrameSaveFailOnSearchBoxSave() {
		$this->setExpectedException('InternalErrorException');

		$mock = $this->getMockForModel('SearchBoxes.SearchBox', ['saveAssociated']);
		$mock->expects($this->any())
			->method('saveAssociated')
			->will($this->returnValue(false));

		$mock->afterFrameSave([
			'Frame' => [
				'key' => 'frame_191',
			],
		]);
	}

/**
 * Expect SearchBox->saveSetting() fail on search box target plugin delete
 * e.g.) connection error
 *
 * @return void
 */
	public function testAfterFrameSaveFailOnSearchBoxTargetPluginDelete() {
		$this->setExpectedException('InternalErrorException');

		$mock = $this->getMockForModel('SearchBoxes.SearchBoxTargetPlugin', ['deleteAll']);
		$mock->expects($this->any())
			->method('deleteAll')
			->will($this->returnValue(false));

		$this->SearchBox->saveSettings([
			'SearchBox' => [
				'id' => '1',
				'frame_key' => 'frame_191',
				'created_user' => '1',
				'modified_user' => '1',
				'is_advanced' => '1',
			],
			'Frame' => [
				'key' => 'frame_191',
			],
			'SearchBoxTargetPlugin' => [
				'plugin_key' => [
					0 => 'announcements',
					1 => 'bbses',
					2 => 'blogs',
					3 => 'circular_notices',
					4 => 'questionnaires',
				],
			],
		]);
	}

/**
 * Expect SearchBox->saveSetting() fail on search box target plugin save
 * e.g.) connection error
 *
 * @return void
 */
	public function testAfterFrameSaveFailOnSearchBoxTargetPluginSave() {
		$this->setExpectedException('InternalErrorException');

		$mock = $this->getMockForModel('SearchBoxes.SearchBoxTargetPlugin', ['saveAssociated']);
		$mock->expects($this->any())
			->method('saveAssociated')
			->will($this->returnValue(false));

		$this->SearchBox->saveSettings([
			'SearchBox' => [
				'id' => '1',
				'frame_key' => 'frame_191',
				'created_user' => '1',
				'modified_user' => '1',
				'is_advanced' => '1',
			],
			'Frame' => [
				'key' => 'frame_191',
			],
			'SearchBoxTargetPlugin' => [
				'plugin_key' => [
					0 => 'announcements',
					1 => 'bbses',
					2 => 'blogs',
					3 => 'circular_notices',
					4 => 'questionnaires',
				],
			],
		]);
	}
}
