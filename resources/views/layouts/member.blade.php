		
	    <div class="col-md-2" id = "membernav">
	    <label>Menu</label>
	        <ul>
	            <li><a href="{{url('/company/member/edit/name/'.$member->id)}}" >Edit Name</a></li>
	            <li><a href="{{url('/company/member/edit/email/'.$member->id)}}" >Edit Email</a></li>
	            <li><a href="{{url('/company/member/edit/reset/'.$member->id)}}" >Change Password</a></li>
	            <li><a href="#" >Edit Address</a></li>
	            <li><a href="{{url('/company/member/edit/team/'.$member->id)}}" >Change Team</a></li>
	            <li><a href="{{url('company/member/view')}}" >View Members</a></li>
	        </ul>
	    </div>
	          