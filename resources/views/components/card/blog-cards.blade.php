<!-- blog-cards component -->
<div>
    <!-- $slot variable to be filled with content where the component is imported in -->
    {{ $slot }}
    <div class="text-right mt-4">
        <button class="view-blog-btn"><a {{ $attributes }}>View Blog</a></button>
    </div>
</div>