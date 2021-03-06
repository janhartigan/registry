<?php
use Registry\Abstracts\AbstractSeeder;
use Registry\Package;

class SeedMaintainers extends AbstractSeeder
{
	/**
	 * Seed the packages
	 *
	 * @return void
	 */
	public function run()
	{
		foreach ($this->packages->all() as $package) {
			$maintainers = $package->getPackagist()['maintainers'];
			foreach ($maintainers as &$maintainer) {
				$maintainer = $this->getExisting($maintainer)->id;
			}

			$package->maintainers()->sync($maintainers);
		}
	}

	/**
	 * Get the Maintainer model
	 *
	 * @param  array $maintainer
	 *
	 * @return Maintainer
	 */
	protected function getExisting(array $maintainer)
	{
		$name = array_get($maintainer, 'name');

		return $this->maintainers->updateOrCreate(array(
			'name'     => $name,
			'email'    => array_get($maintainer, 'email'),
			'homepage' => array_get($maintainer, 'homepage'),
			'github'   => 'http://github.com/'.$name,
		));
	}
}
