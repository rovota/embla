<?php
/**
 * @copyright   Léandro Tijink
 * @license     MIT
 */

namespace Rovota\Embla\Views\Traits;

use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Fluent;

trait WebFunctions
{

	public function withSlug(string $value): static
	{
		return $this->with('highlight_slug', $value);
	}

	public function withTab(string $value): static
	{
		return $this->with('highlight_tab', $value);
	}

	public function withOverlay(string $target): static
	{
		return $this->with('trigger_overlay', new Fluent([
			'target' => $target,
		]));
	}

	public function withParent(string $action, string|null $value = null): static
	{
		return $this->with('trigger_parent', new Fluent([
			'action' => $action,
			'value' => $value,
		]));
	}

	// -----------------

	public function withTitle(string $title, array|object $data = []): static
	{
		return $this->with('title', Lang::get(trim($title), $data));
	}

//	public function withDescription(string $description): static
//	{
//		$description = Lang::get(trim($description));
//
//		$this->with('page.description', $description);
//		$this->withMeta('description', ['name' => 'description', 'content' => $description]);
//		$this->withMeta('og:description', ['name' => 'og:description', 'content' => Lang::get($description)]);
//
//		Partials::updateVariable('page', [
//			'description' => $description,
//		]);
//
//		return $this;
//	}

	// -----------------

//	public function withKeywords(array $keywords): static
//	{
//		$keywords = implode(',', $keywords);
//
//		$this->with('page.keywords', $keywords);
//		$this->withMeta('keywords', ['name' => 'keywords', 'content' => $keywords]);
//
//		Partials::updateVariable('page', [
//			'keywords' => $keywords,
//		]);
//
//		return $this;
//	}

//	public function withAuthor(string $author): static
//	{
//		$this->with('page.author', $author);
//		$this->withMeta('author', ['name' => 'author', 'content' => $author], true);
//
//		Partials::updateVariable('page', [
//			'author' => $author,
//		]);
//
//		return $this;
//	}

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
//		PartialManager::addOrUpdateVariable('page', [
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