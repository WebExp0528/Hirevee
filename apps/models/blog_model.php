<?php
class Blog_model extends CI_Model
{
	function __construct()
	{
		// Call the Model constructor
		parent::__construct();
	}
	
	function get_category($id = '')
	{
		if ($id == '')
			$query = $this->db->order_by('id', 'ASC')->get('blog_category');
		else
			$query = $this->db->order_by('id', 'ASC')->get_where('blog_category', array('id' => $id));
		return $query->result();
	}
	
	function get_comment($id)
	{
		$this->db->where('id_blog', $id);
		$this->db->order_by('post_date', 'DESC');
		$query = $this->db->get('blog_comment');
		return $query;
	}
	
	function get_article($id)
	{
		$querystr = 'SELECT blog.*, (select count(id) from `blog_comment` where blog_comment.id_blog=`blog`.id) as comment , (select name from `users` where users.id=`blog`.id_user ) as name FROM blog WHERE id=' . $id;
		
		$query = $this->db->query($querystr);
		if ($query->num_rows() > 0)
		{
			foreach ($query->result() as $row)
			{
				$data[] = $row;
			}
			return $data;
		}
		return false;
	}
	
	function insert_article($data)
	{
		$this->load->helper('date');
		$time = mdate('Y-m-d H:m:s');
		
		$insert_data = array('id_blog' => $data['user_id'], 'comment' => $data['comment'], 'subject' => $data['subject'], 'post_date' => $time, 'author_name' => $data['name'], 'author_email' => $data['email'], 'allow' => 'N');
		if (!empty($insert_data))
		{
			
			$result = $this->db->insert('blog_comment', $insert_data);
		}
		return $result;
	
	}
	
	function update_entry($data)
	{
		$this->subject = $data['subject'];
		$this->content = $data['content'];
		$this->publish_date = date('c');
		$this->author = $data['author'];
		$this->comment_number = $data['comment_number'];
		$this->image_url = $data['image_url'];
		
		$this->db->update('blog', $this);
	}
	
	public function search_count($search_key)
	{
		$querystr = 'select blog.*, (select count(id) from `blog_comment` where blog_comment.id_blog=`blog`.id) as comment , (select name from `users` where users.id=`blog`.id_user ) as name FROM blog  inner join users on users.id=blog.`id_user` WHERE subject LIKE \'%' . $search_key . '%\' OR name LIKE \'%' . $search_key . '%\'  OR content LIKE \'%' . $search_key . '%\'';
		$query = $this->db->query($querystr);
		return count($query->result());
	}
	
	public function record_count($id_category = 0)
	{
		if ($id_category == 0)
		{
			$querystr = 'select blog.*, (select count(id) from `blog_comment` where blog_comment.id_blog=`blog`.id) as comment , (select name from `users` where users.id=`blog`.id_user ) as name FROM blog';
		}
		else
		{
			$querystr = 'select blog.*, (select count(id) from `blog_comment` where blog_comment.id_blog=`blog`.id) as comment , (select name from `users` where users.id=`blog`.id_user ) as name FROM blog WHERE blog.id_category=' . $id_category;
		}
		$query = $this->db->query($querystr);
		return count($query->result());
	}
	
	function getsearch_blog($limit = 7, $start = 0, $search_key)
	{
		$querystr = 'select blog.*, (select count(id) from `blog_comment` where blog_comment.id_blog=`blog`.id) as comment , (select name from `users` where users.id=`blog`.id_user ) as name FROM blog  inner join users on users.id=blog.`id_user` WHERE subject LIKE \'%' . $search_key . '%\' OR name LIKE \'%' . $search_key . '%\'  OR content LIKE \'%' . $search_key . '%\' LIMIT ' . $start . ' , ' . $limit;
		$query = $this->db->query($querystr);
		
		if ($query->num_rows() > 0)
		{
			foreach ($query->result() as $row)
			{
				$data[] = $row;
			}
			return $data;
		}
		return false;
	
	}
	
	function getblog($limit = 7, $start = 0, $id_category = 0)
	{
		
		//$query = $this->db->get("blog" );
		if ($id_category == 0)
		{
			$querystr = 'select blog.*, (select count(id) from `blog_comment` where blog_comment.id_blog=`blog`.id) as comment , (select name from `users` where users.id=`blog`.id_user ) as name FROM blog ORDER BY id LIMIT ' . $start . ' , ' . $limit;
		}
		else
		{
			$querystr = 'select blog.*, (select count(id) from `blog_comment` where blog_comment.id_blog=`blog`.id) as comment , (select name from `users` where users.id=`blog`.id_user ) as name FROM blog WHERE blog.id_category=' . $id_category . ' ORDER BY id LIMIT ' . $start . ' , ' . $limit;
		}
		
		$query = $this->db->query($querystr);
		if ($query->num_rows() > 0)
		{
			foreach ($query->result() as $row)
			{
				$data[] = $row;
			}
			return $data;
		}
		return false;
	}
	
	function getlastpost()
	{
		$querystr = 'select blog.*, (select count(id) from `blog_comment` where blog_comment.id_blog=`blog`.id) as comment , (select name from `users` where users.id=`blog`.id_user ) as name FROM blog ORDER BY publish_date desc LIMIT 0,3';
		$query = $this->db->query($querystr);
		if ($query->num_rows() > 0)
		{
			foreach ($query->result() as $row)
			{
				$data[] = $row;
			}
			return $data;
		}
		return false;
	
	}
	
	function addblog($data)
	{
		$querystr = 'select id from blog_category where category=\'' . $data['category'] . '\'';
		$query = $this->db->query($querystr);
		$temp = $query->result();
		
		$add['id_category'] = $temp[0]->id;
		$add['attach_file'] = $data['file_name'];
		$add['id_user'] = $data['id'];
		$add['subject'] = $data['subject'];
		$add['content'] = $data['content'];
		$add['allow'] = $data['allow'];
		
		$this->load->helper('date');
		$time = mdate('Y-m-d H:m:s');
		$add['publish_date'] = $time;
		$this->db->insert('blog', $add);
	}
	function update_blog($data)
	{
		$querystr = 'select id from blog_category where category=\'' . $data['category'] . '\'';
		$query = $this->db->query($querystr);
		$temp = $query->result();
		
		$add['id_category'] = $temp[0]->id;
		$add['attach_file'] = $data['file_name'];
		$add['id_user'] =  $this->logged_user->get_item('id');
		$add['subject'] = $data['subject'];
		$add['content'] = $data['content'];
		$add['allow'] = $data['allow'];
		
		
		$this->load->helper('date');
		$time = mdate('Y-m-d H:m:s');
		$add['publish_date'] = $time;		
		
		$this->db->where('id', $data['id']);
		$this->db->update('blog', $add);
		
		
	}
	
	function get_counts($option = null, $value = null)
	{
		$where = array();
		if (!is_null($option))
		{
			$where[$option] = $value;
		}
		
		$result = $this->db->select('COUNT(id) AS cnt')->get_where('blog', $where);
		if ($result->num_rows == 0)
			return 0;
		
		$row = $result->result();
		return $row[0]->cnt;
	}
	
	function get_new_counts()
	{
		$today = date('Y-m-d H:i:s', mktime(0, 0, 0, date('m'), date('d'), date('Y')));
		
		$sql = 'SELECT COUNT(id) AS cnt FROM blog WHERE publish_date >= \'' . $today . '\'';
		$result = $this->db->query($sql);
		if ($result->num_rows == 0)
			return 0;
		
		$row = $result->result();
		return $row[0]->cnt;
	}
	
	function get_blog_list($limit = null, $offset = null)
	{
		$sql = 'SELECT b.*, bc.category, u.id AS userid, u.name, u.email, (SELECT COUNT(id) FROM blog_comment WHERE id_blog = b.id ) AS comments 
				FROM blog b 
				INNER JOIN blog_category bc ON bc.id = b.id_category 
				INNER JOIN users u ON u.id = b.id_user 
				ORDER BY publish_date DESC';
		if (!is_null($limit) && !is_null($offset))
		{
			$sql .= ' LIMIT ' . $offset . ', ' . $limit;
		}
		
		$query = $this->db->query($sql);
		return $query;
	}
	
	function get_by_id($id)
	{
		$sql = 'SELECT b.*, bc.category, u.id AS userid, u.name, u.email, (SELECT COUNT(id) FROM blog_comment WHERE id_blog = b.id ) AS comments 
				FROM blog b 
				INNER JOIN blog_category bc ON bc.id = b.id_category 
				INNER JOIN users u ON u.id = b.id_user 
				WHERE b.id = \'' . $id . '\'';
		
		$query = $this->db->query($sql);
		if ($query->num_rows() == 0)
		{
			return false;
		}
		$row = $query->result();
		return $row[0];
	}
	
	function set_state($id, $state)
	{
		$result = $this->db->update('blog', array('allow' => $state), array('id' => $id));
		return $result;
	}
	
	function delete($id)
	{
		$result = $this->db->delete('blog', array('id' => $id));
		return $result;
	}
	
	function update($id, $data)
	{
		$result = $this->db->update('blog', $data, array('id' => $id));
		return $result;
	}
	
	function comment_set_state($id, $state)
	{
		$result = $this->db->update('blog_comment', array('allow' => $state), array('id' => $id));
		return $result;
	}
	
	function comment_delete($id)
	{
		$result = $this->db->delete('blog_comment', array('id' => $id));
		return $result;
	}
	
	function category_add($data)
	{
		$result = $this->db->insert('blog_category', $data);
		return $result;
	}
	
	function category_update($id, $data)
	{
		$result = $this->db->update('blog_category', $data, array('id' => $id));
		return $result;
	}
	
	function category_delete($id)
	{
		$result = $this->db->delete('blog_category', array('id' => $id));
		return $result;
	}
}

?>