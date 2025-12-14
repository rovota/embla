<div class="border">
	<canvas id="drawing" width="300" height="150" data-input="drawing" data-pencil="#666666"></canvas>
	<div class="border-t">
		<span class="button accent-danger" id="clear">{!! icon('actions.trash') !!}</span>
		<x-embla::input has="drawing">
			<label class="group border rounded-md border-dashed border-neutral-500/40 hover:border-neutral-500/70 focus-within:border-neutral-500 cursor-pointer">
				<x-embla::input.file name="drawing" accept="image/webp,image/jpeg,image/png"/>
				<div class="fallback flex w-full p-5 opacity-65 justify-center group-focus-within:opacity-100">
					{{ __('Select file') }}
				</div>
				<div class="details hidden w-full p-5 justify-center">{{ __('%1$s selected') }}</div>
			</label>
		</x-embla::input>
	</div>
</div>