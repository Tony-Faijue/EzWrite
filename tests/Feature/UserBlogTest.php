<?php

namespace Tests\Feature;

use App\Models\Blog;
use App\Models\BlogSection;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class UserBlogTest extends TestCase
{
    use RefreshDatabase;
    /**
     * Test if user can view their blog 
     */
    public function test_authorized_user_can_view_their_blog_and_sections(): void
    {
        //Create a User with a blog and sections
        $user = User::factory()->create();
        $blog = Blog::factory()->for($user)->create();
        BlogSection::factory()->count(3)->for($blog)->create();


        //Get the response of the user at the specified route
        $response = $this->actingAs($user)->get(route('user-blogs-show', $blog));

        //Assert the response returns the correct view and view data
        $response->assertStatus(200)
            ->assertViewIs('user.blog')
            ->assertViewHas('blog', fn($b) => $b->id === $blog->id)
            ->assertViewHas('sections', fn($sections) => $sections->count() === 3);
    }
    /**
     * Test to make sure only the authorized user can view their blog from their user entry point
     * @return void
     */
    public function test_unauthorized_user_can_not_view_authorized_user_blog_from_authorized_user_entry_point()
    {
        $owner = User::factory()->create();
        $attacker = User::factory()->create();
        $blog = Blog::factory()->for($owner)->create();

        //Get response of the attacker trying to view the blog of the owner
        $response = $this->actingAs($attacker)->get(route('user-blogs-show', $blog));

        $response->assertStatus(404);
    }
    /**
     * Test authorized user can create blog with image url
     * @return void
     */
    public function test_authorized_user_can_create_blog_with_image_url()
    {
        //Use local test disk
        Storage::fake('public');

        $user = User::factory()->create();

        // payload for the blog data
        $payload = [
            'hero_title' => 'My Hero Title',
            'intro' => 'My Introduction',
            'is_public' => true,
            'hero_topics' => ['Topic A', 'Topic B', '  '],
            'hero_authors' => ['Bob', '', 'John', ' '],
            'hero_image_url' => 'https://images.unsplash.com/photo-1566438480900-0609be27a4be?w=1000&auto=format&fit=crop&q=60&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxzZWFyY2h8NHx8aW1hZ2V8ZW58MHx8MHx8fDA%3D',
            'footer_about' => 'Footer Details',
        ];

        //Create blog with payload at the store route
        $response = $this->actingAs($user)->post(route('user-blogs-store', $payload));

        //Assert the redirect with flash message
        $response->assertRedirect(route('user-blogs-index'))
            ->assertSessionHas('Success', 'Blog Successfully Created!');

        //Assert the database record exist
        $this->assertDatabaseHas('blogs', [
            'hero_title' => 'My Hero Title',
            'intro' => 'My Introduction',
            'is_public' => 1,
            'hero_image' => 'https://images.unsplash.com/photo-1566438480900-0609be27a4be?w=1000&auto=format&fit=crop&q=60&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxzZWFyY2h8NHx8aW1hZ2V8ZW58MHx8MHx8fDA%3D',
            'footer_about' => 'Footer Details',
            'user_id' => $user->id,
        ]);

        //Find the created blog
        $blog = Blog::where('hero_title', 'My Hero Title')->first();

        //Assert blank entries were removed and arrays reindexed
        $this->assertEquals(['Topic A', 'Topic B'], $blog->hero_topics);
        $this->assertEquals(['Bob', 'John'], $blog->hero_authors);
    }
    /**
     * Test user can create blog with image file
     * @return void
     */
    public function test_authorized_user_can_create_blog_with_uploaded_image_file()
    {
        //Use local test disk
        Storage::fake('public');

        $user = User::factory()->create();

        //Use a real image at designated path
        $path = base_path('tests/images/test.jpg');

        //Verify file exist
        $this->assertTrue(file_exists($path), "Test image file does not exist at: {$path}");

        //Create image file
        $file = new UploadedFile(
            $path,
            'hero.jpg',
            'image/jpg',
            null,
            true
        );

        //Create payload for blog data
        $payload = [
            'hero_title' => 'File Hero',
            'intro' => 'File Hero Introduction',
            'is_public' => false,
            'hero_topics' => [],
            'hero_authors' => [],
            'hero_image_file' => $file,
            'footer_about' => 'Footer',
        ];

        //Create blog resource at store route and redirect
        $response = $this->actingAs($user)->post(route('user-blogs-store'), $payload);

        $response->assertRedirect(route('user-blogs-index'));
        $response->assertSessionHasNoErrors();

        //Find the created blog and check if the image is not null
        $blog = Blog::where('hero_title', 'File Hero')->first();
        $this->assertNotNull($blog->hero_image);

        //Assert the image file exists
        $this->assertTrue(Storage::disk('public')->exists($blog->hero_image), "Blog Image not stored at {$blog->hero_image}");
        $this->assertDatabaseHas('blogs', [
            'hero_title' => 'File Hero',
            'is_public' => 0,
            'user_id' => $user->id,
        ]);
    }
    /**
     * Test user can update their created blog
     * @return void
     */
    public function test_user_can_update_blog()
    {
        Storage::fake('public');
        $user = User::factory()->create();

        $blog = Blog::factory()->create([
            'user_id' => $user->id,
            'hero_title' => 'Title',
            'intro' => 'intro',
            'is_public' => false,
            'hero_topics' => ['Topic'],
            'hero_authors' => ['Author'],
            'hero_image' => 'https://example.com/image.jpg',
            'footer_about' => 'footer',
        ]);

        //update blog payload
        $updatedPayload = [
            'hero_title' => 'Updated Hero Title',
            'intro' => 'Updated Introduction',
            'is_public' => false,
            'hero_topics' => ['Updated Topic A', 'Updated Topic B', '  '],
            'hero_authors' => ['Alice', '', 'Charlie', ' '],
            'hero_image_url' => 'https://images.unsplash.com/photo-1566438480900-0609be27a4be',
            'footer_about' => 'Updated Footer Details',
        ];

        //Make update request
        $response = $this->actingAs($user)->put(route('user-blogs-update', $blog), $updatedPayload);
        //assert the redirect
        $response->assertRedirect(route('user-blogs-index'))->assertSessionHas('Success', 'Blog Updated Successfully!');

        //assert the database is updated
        $this->assertDatabaseHas('blogs', [
            'id' => $blog->id,
            'hero_title' => 'Updated Hero Title',
            'intro' => 'Updated Introduction',
            'is_public' => 0,
            'hero_image' => 'https://images.unsplash.com/photo-1566438480900-0609be27a4be',
            'footer_about' => 'Updated Footer Details',
            'user_id' => $user->id,
        ]);

        //Refresh the blog model and test array filtering
        $blog->refresh();

        $this->assertEquals(['Updated Topic A', 'Updated Topic B'], $blog->hero_topics);
        $this->assertEquals(['Alice', 'Charlie'], $blog->hero_authors);
    }
    /**
     * Test user can update blog with uploaded file
     * @return void
     */
    public function test_user_can_update_blog_with_uploaded_file()
    {
        Storage::fake('public');
        $user = User::factory()->create();

        $blog = Blog::factory()->create([
            'user_id' => $user->id,
            'hero_title' => 'Title',
            'intro' => 'intro',
            'is_public' => false,
            'hero_image' => 'https://example.com/image.jpg',
        ]);

        $path = base_path('tests/images/test.jpg');
        $this->assertTrue(file_exists($path), "Test image file does not exist at: {$path}");

        $file = new UploadedFile(
            $path,
            'hero.jpg',
            'image/jpg',
            null,
            true
        );

        $payload = [
            'hero_title' => $blog->hero_title,
            'intro' => $blog->intro,
            'is_public' => $blog->is_public,
            'hero_topics' => $blog->hero_topics ?? [],
            'hero_authors' => $blog->hero_authors ?? [],
            'hero_image_file' => $file,
            'footer_about' => $blog->footer_about,
        ];

        $response = $this->actingAs($user)
            ->put(route('user-blogs-update', $blog), $payload);

        $response->assertRedirect(route('user-blogs-index'))
            ->assertSessionHas('Success', 'Blog Updated Successfully!');

        $blog->refresh();

        // Assert new image was stored
        $this->assertNotNull($blog->hero_image);
        $this->assertStringStartsWith('heroimages/', $blog->hero_image);
        $this->assertTrue(Storage::disk('public')->exists($blog->hero_image));

    }
    /**
     * Test unauthorized user cannot update a user's blog
     * @return void
     */
    public function test_unauthorized_user_cannot_update_blog()
    {
        $owner = User::factory()->create();
        $attacker = User::factory()->create();

        $blog = Blog::factory()->create(['user_id' => $owner->id]);

        $payload = ['hero_title' => 'Hacked Title'];

        $response = $this->actingAs($attacker)
            ->put(route('user-blogs-update', $blog), $payload);

        $response->assertStatus(404);

        // Assert blog was not changed
        $this->assertDatabaseMissing('blogs', [
            'id' => $blog->id,
            'hero_title' => 'Hacked Title'
        ]);
    }
    /**
     * Test user can delete their blog
     * @return void
     */
    public function test_user_can_delete_their_blog()
    {
        $user = User::factory()->create();

        // create a quick blog
        $blog = Blog::factory()->create([
            'user_id' => $user->id,
            'hero_title' => 'Blog to Delete'
        ]);

        // store the blog ID for later assertion
        $blogId = $blog->id;

        // Make DELETE request to destroy the blog
        $response = $this->actingAs($user)
            ->delete(route('user-blogs-delete', $blog));

        // Assert redirect with success message
        $response->assertRedirect(route('user-blogs-index'))
            ->assertSessionHas('Success', 'Blog Successfully Deleted!');

        //Check the blog model no longer exists
        $this->assertNull(actual: Blog::find($blogId));
    }
    /**
     * Test user can delete blog and stored local image
     * @return void
     */
    public function test_user_can_delete_blog_with_local_image()
    {
        Storage::fake('public');

        $user = User::factory()->create();

        // Create a fake image file in storage
        $imagePath = 'heroimages/test-image.jpg';
        Storage::disk('public')->put($imagePath, 'fake-image-content');

        // Verify the image exists before deletion
        $this->assertTrue(Storage::disk('public')->exists($imagePath));

        // Create blog with local image
        $blog = Blog::factory()->create([
            'user_id' => $user->id,
            'hero_image' => $imagePath
        ]);

        $response = $this->actingAs($user)
            ->delete(route('user-blogs-delete', $blog));

        $response->assertRedirect(route('user-blogs-index'))
            ->assertSessionHas('Success', 'Blog Successfully Deleted!');

        // Assert blog was deleted
        $this->assertNull(actual: Blog::find($blog->id));
    }
    /**
     * Test unauthorized user cannot delete the blog of another user
     * @return void
     */
    public function test_unauthorized_user_cannot_delete_blog()
    {
        $owner = User::factory()->create();
        $attacker = User::factory()->create();

        // Create owner user
        $blog = Blog::factory()->create([
            'user_id' => $owner->id,
            'hero_title' => 'Protected Blog'
        ]);

        // Try to delete blog owner as the attacker
        $response = $this->actingAs($attacker)
            ->delete(route('user-blogs-delete', $blog));

        // Assert 403 Forbidden response
        $response->assertStatus(403);

        // Assert blog still exists in database
        $this->assertDatabaseHas('blogs', [
            'id' => $blog->id,
            'hero_title' => 'Protected Blog',
            'user_id' => $owner->id
        ]);
    }
    /**
     * Test guest is redirected when trying to accessing create blog route
     * @return void
     */
    public function test_guest_cannot_create_blog()
    {
        $response = $this
            ->post(route('user-blogs-store'), [
                'hero_title' => 'Nope',
                'intro' => 'Should not pass',
                'is_public' => true,
            ]);

        $response->assertRedirect(route('login'));
    }
    /**
     * Test guest cannot update a blog
     * @return void
     */
    public function test_guest_cannot_update_blog()
    {
        $user = User::factory()->create();

        $blog = Blog::factory()->create([
            'user_id' => $user->id,
            'hero_title' => 'Original Title'
        ]);

        $payload = [
            'hero_title' => 'Hacked Title',
            'intro' => 'Hacked intro',
            'is_public' => true,
        ];

        // Try to update without authentication
        $response = $this->put(route('user-blogs-update', $blog), $payload);

        // Redirect to login page
        $response->assertRedirect(route('login'));

        // Assert that blog remained unchanged
        $this->assertDatabaseHas('blogs', [
            'id' => $blog->id,
            'hero_title' => 'Original Title',
            'user_id' => $user->id
        ]);
    }
    /**
     * Test guest cannot delete a blog
     * @return void
     */
    public function test_guest_cannot_delete_blog()
    {
        $user = User::factory()->create();

        $blog = Blog::factory()->create([
            'user_id' => $user->id
        ]);

        // Try to delete without authentication
        $response = $this->delete(route('user-blogs-delete', $blog));

        //Redirect to login page
        $response->assertRedirect(route('login'));

        // Assert that the blog still exists
        $this->assertDatabaseHas('blogs', [
            'id' => $blog->id,
            'user_id' => $user->id
        ]);
    }
}
