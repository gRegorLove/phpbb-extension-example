<?php
/**
 *
 * MAPP Example. An extension for the phpBB Forum Software package.
 *
 * @copyright (c) 2020, Gregor Morrill, https://stevens-stevens.com
 * @license GNU General Public License, version 2 (GPL-2.0)
 *
 */

namespace mapp\example\cron\task;

/**
 * MAPP Example cron task.
 */
class sample extends \phpbb\cron\task\base
{
	/**
	 * How often we run the cron (in seconds).
	 * @var int
	 */
	protected $cron_frequency = 60;

	/** @var \phpbb\config\config */
	protected $config;

	/** @var \phpbb\log\log */
	protected $log;

	/**
	 * Constructor
	 *
	 * @param \phpbb\config\config $config Config object
	 */
	public function __construct(\phpbb\config\config $config, \phpbb\log\log $log)
	{
		$this->config = $config;
		$this->log = $log;
		// $this->log->add('admin', 2, '127.0.0.1', 'sample.construct');
	}

	/**
	 * Runs this cron task.
	 *
	 * @return void
	 */
	public function run()
	{
		$this->log->add('admin', 2, '127.0.0.1', 'sample.run');
		// Run your cron actions here...

		// Update the cron task run time here if it hasn't
		// already been done by your cron actions.
		$this->config->set('example_cron_last_run', time(), false);
	}

	/**
	 * Returns whether this cron task can run, given current board configuration.
	 *
	 * For example, a cron task that prunes forums can only run when
	 * forum pruning is enabled.
	 *
	 * @return bool
	 */
	public function is_runnable()
	{
		$this->log->add('admin', 2, '127.0.0.1', 'sample.is_runnable');
		return true;
	}

	/**
	 * Returns whether this cron task should run now, because enough time
	 * has passed since it was last run.
	 *
	 * @return bool
	 */
	public function should_run()
	{
		$this->log->add('admin', 2, '127.0.0.1', 'sample.should_run');
		return $this->config['example_cron_last_run'] < time() - $this->cron_frequency;
	}
}
