<?php
namespace OCA\FilesScripts\Interpreter\Functions\Nextcloud;

use OCA\FilesScripts\Interpreter\RegistrableFunction;

/**
 * `tag_create(String name, [Bool user_visible= true], [Bool user_assignable= true]): ?Tag`
 *
 * Creates a collaborative tag. Returns the created tag, or `nil` if the tag could not be created (i.e. a tag with the same name already exists).
 */
class Tag_Create extends RegistrableFunction {
	use TagsCommand;

	public function run($name = null, $user_visible = true, $user_assignable = true): ?array {
		if (!$name) {
			return null;
		}

		try {
			$tag = $this->tagManager->createTag($name, $user_visible, $user_assignable);
		} catch (\Throwable $t) {
			return null;
		}

		return $this->serializeTag($tag);
	}
}