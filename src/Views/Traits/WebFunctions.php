<?php

/**
 * @copyright   Léandro Tijink
 * @license     MIT
 */

namespace Rovota\Embla\Views\Traits;

use Rovota\Embla\Facades\Partials;
use Rovota\Framework\Support\Str;

trait WebFunctions
{

	public function withSlug(string $value): static
	{
		$this->with('page.slug', trim($value));

		Partials::updateVariable('page', [
			'slug' => $value,
		]);

		return $this;
	}

	public function withTab(string $value): static
	{
		$this->with('page.tab', trim($value));

		Partials::updateVariable('page', [
			'tab' => $value,
		]);

		return $this;
	}

	public function withOverlay(string $target): static
	{
		Partials::attachVariable('overlay', [
			'target' => $target,
		]);
		return $this;
	}

	public function withParent(string $action, string|null $value = null): static
	{
		Partials::attachVariable('parent', [
			'action' => $action,
			'value' => $value,
		]);
		return $this;
	}

	// -----------------

	public function withTitle(string $title, array|object $data = []): static
	{
		$title = Str::translate(trim($title), $data);

		$this->with('page.title', $title);
		$this->withMeta('og:title', ['name' => 'og:title', 'content' => $title]);

		Partials::updateVariable('page', [
			'title' => $title,
		]);

		return $this;
	}

	public function withDescription(string $description): static
	{
		$description = Str::translate(trim($description));

		$this->with('page.description', $description);
		$this->withMeta('description', ['name' => 'description', 'content' => $description]);
		$this->withMeta('og:description', ['name' => 'og:description', 'content' => Str::translate($description)]);

		Partials::updateVariable('page', [
			'description' => $description,
		]);

		return $this;
	}

	// -----------------

	public function withKeywords(array $keywords): static
	{
		$keywords = implode(',', $keywords);

		$this->with('page.keywords', $keywords);
		$this->withMeta('keywords', ['name' => 'keywords', 'content' => $keywords]);

		Partials::updateVariable('page', [
			'keywords' => $keywords,
		]);

		return $this;
	}

	public function withAuthor(string $author): static
	{
		$this->with('page.author', $author);
		$this->withMeta('author', ['name' => 'author', 'content' => $author], true);

		Partials::updateVariable('page', [
			'author' => $author,
		]);

		return $this;
	}

	// -----------------

//	TODO: Add withImage method based on the method below.
//
//	public function setImage(FileInterface|string $location): static
//	{
//		$public_url = match (true) {
//			$location instanceof FileInterface => $location->publicUrl(),
//			default => $location,
//		};
//
//		PartialManager::addOrUpdateVariable'page', [
//			'image' => $public_url,
//		]);
//
//		$this->meta('og:image', ['content' => $public_url]);
//		$this->meta('og:image:secure_url', ['content' => $public_url]);
//		$this->meta('twitter:image', ['content' => $public_url]);
//
//		return $this;
//	}

}