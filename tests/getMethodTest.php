<?php

class GetMethodTest extends LocalWebTestCase
{
    // public function testGetAllBlogsResponse()
    // {
    //     $this->client->get('/blogs/');
    //     
    //     $this->assertEquals(200, $this->client->response->status());
    // }
    
    /**
     * Struggling with bug when having several tests returning 200 response
     * When fixed can swap to data provider testing etc
     */
    public function testGetBlogByID()
    {
    	$this->client->get('/blogs/');
        $this->assertEquals(200, $this->client->response->status());

        $this->client->get('/blogs/6');
        $this->assertEquals(200, $this->client->response->status());

        $this->client->get('/blogs/7');
        $this->assertEquals(200, $this->client->response->status());

        $this->client->get('/blogs/hi');
        $this->assertEquals(404, $this->client->response->status());

        $this->client->get('/blogs/1000');
        $this->assertEquals(404, $this->client->response->status());
    }


    /**
	 * @dataProvider routeProvider
	 */
	// public function testRoutesIdCondition($route, $response)
	// {
	//     $this->client->get($route);
	//     //var_dump($this->client->response);
	//     $this->assertEquals($response, $this->client->response->status());
	// }

	// public function routeProvider()
	// {
	//     return array(
	// 		array('/blogs/6', 200),
	// 		//array('/blogs/6', 200),
	// 		// array('/blogs/200', 404),
	// 		// array('/blogs/hi', 404),
	// 		//array('/blogs/6', 200),
	//     );
	// }
}