 /*
creating the WSDL 
 java -cp ./axis.jar:./commons-logging-1.0.4.jar:./commons-discovery-0.2.jar:./saaj.jar:./wsdl4j-1.5.1.jar:./jaxrpc.jar  org.apache.axis.wsdl.WSDL2Java http://cipcnet/moodle/wspp/wsdl_pp.php

JavaDOC :

javadoc -d ~/public_html/moodlews/java/javadoc fr.insa_lyon.cipcnet.moodle.wspp.wsdl *.java 
 

 Compilation :  
 javac -cp ./axis.jar:./jaxrpc.jar:. Test1.java
 
 Execution : 
 java -cp ./axis.jar:./commons-logging-1.0.4.jar:./commons-discovery-0.2.jar:saaj.jar::wsdl4j-1.5.1.jar:./jaxrpc.jar:.  Test1

*/

// adjust the import to your Moodle wsdl created by WSDL2Java !!!
//import localhost.moodle20.wspp.wsdl.*;
import fr.insa_lyon.prope.moodle_195.wspp.wsdl.*; 

import org.apache.axis.AxisFault;
// GRR WSDL2Java traduced xsd:integer to java.math.BigInteger class ...
//import java.math.BigInteger;

public class Test1  {


	public static void main (String[] args) {
	
		MoodleWSLocator service= new MoodleWSLocator();
		try {
	
			MoodleWSPortType port=service.getMoodleWSPort();
			
			System.out.println ("login in");
			LoginReturn lr=port.login ("xxxxx","zzzzzz");
			System.out.println ("LR.client:"+lr.getClient());
			System.out.println ("LR.key:"+lr.getSessionkey());
			
			int myId=	port.get_my_id(lr.getClient(),
						lr.getSessionkey());
			System.out.println ("My Moodle id "+myId);
			
			
			System.out.println ("Who am i ?");
			UserRecord me=port.get_user_byid(
					lr.getClient(),
					lr.getSessionkey(),
					""+myId  // .toString()   // strange, should be numeric ?
					).getUsers()[0];
			
			System.out.println (me.getError()+
					 "\t"+me.getUsername()+
					 "\t"+me.getFirstname()+
					 "\t"+me.getLastname()+
					"\t"+me.getEmail()
				);
								
			System.out.println ("get available roles");
			GetRolesReturn grr=port.get_roles(lr.getClient(),
						lr.getSessionkey());
			
			RoleRecord[] rr=grr.getRoles();
			System.out.println(rr.length+" roles");
			
			for (int i=0; i< rr.length;i++)
				System.out.println (
					rr[i].getError()+" "+rr[i].getId()+" "+rr[i].getName()
				
				);
				
			System.out.println ("get available categories");
			CategoryRecord[] cats=port.get_categories(lr.getClient(),
						lr.getSessionkey()).getCategories();
			
			for (int i=0; i< cats.length;i++)
				System.out.println (
					// cats[i].getError()+"\t"+  <-- forgotten 
					cats[i].getId()+"\t"+cats[i].getName()
				
				);

			System.out.println ("get my courses");	
			CourseRecord[] myc=port.get_my_courses(lr.getClient(),
						lr.getSessionkey(),0,null).getCourses();
						
			for (int i=0; i< myc.length;i++) 
			
				System.out.println (
					myc[i].getError()+"\t"+myc[i].getId()+
					"\t"+myc[i].getIdnumber()+
					"\t"+myc[i].getShortname()+
					"\t"+myc[i].getFullname()
				
				);
				
			System.out.println ("get courses with id 1,2 and -1");
			String [] crsList={"1","2","-1"};	
			CourseRecord[] crs1=port.get_courses(lr.getClient(),
						lr.getSessionkey(),
						crsList,
						"id").getCourses();
						
			for (int i=0; i< crs1.length;i++) 
			
				System.out.println (
					crs1[i].getError()+"\t"+crs1[i].getId()+
					"\t"+crs1[i].getIdnumber()+
					"\t"+crs1[i].getShortname()+
					"\t"+crs1[i].getFullname()
				
				);
			System.out.println ("get 15 last change in courses id=2");
			ChangeRecord[] crs=port.get_last_changes(lr.getClient(),
						lr.getSessionkey(),
						"2",   // courseid is string 
						"id",
						15 // arghhh 
					).getChanges();	
			
			for (int i=0; i< crs.length;i++) 
			
				System.out.println (
					crs[i].getError()+"\t"+crs[i].getId()+
					"\t"+crs[i].getAuthor()+
					"\t"+crs[i].getVisible()+
					"\t"+crs[i].getLink()
				
				);
				
			System.out.println ("get groups named 201 in any course");	
			GroupRecord[] grps=port.get_groups_byname(lr.getClient(),
						lr.getSessionkey(),
						"201",   // groupeid is string 
						 0 // all courses arghhh 
					).getGroups();	
			
			for (int i=0; i< grps.length;i++) 
			
				System.out.println (
					grps[i].getError()+"\t"+grps[i].getId()+
					"\t"+grps[i].getName()+
					"\t"+grps[i].getCourseid()
				);
				
			System.out.println ("get teachers of course idnumber=C2I_101");	
			UserRecord[] te=port.get_teachers(lr.getClient(),
						lr.getSessionkey(),
						"C2I_101",   // courseid is string 
						 "idnumber"
					).getUsers();
					
			for (int i=0; i< te.length;i++) 
				System.out.println (
					te[i].getError()+"\t"+te[i].getId()+
					"\t"+te[i].getUsername()+
					"\t"+te[i].getFirstname()+
					"\t"+te[i].getLastname()+
					"\t"+te[i].getEmail()
				);
					
			System.out.println ("get users with idnumber = ppollet, pguy, unknown");
			String[] thems={"ppollet","pguy","astrid","unknown"};
			UserRecord[] usn=port.get_users(lr.getClient(),
						lr.getSessionkey(),
						thems,   // courseid is string 
						 "idnumber" //volontary wrong 
					).getUsers();
					
			for (int i=0; i< usn.length;i++) 
				System.out.println (
					usn[i].getError()+"\t"+usn[i].getId()+
					"\t"+usn[i].getUsername()+
					"\t"+usn[i].getFirstname()+
					"\t"+usn[i].getLastname()+
					"\t"+usn[i].getEmail()
				);
			
			System.out.println ("Try again :get users with username = ppollet, pguy, unknown");
			usn=port.get_users(lr.getClient(),
						lr.getSessionkey(),
						thems,   // courseid is string 
						 "username" 
					).getUsers();
					
			for (int i=0; i< usn.length;i++) 
				System.out.println (
					usn[i].getError()+"\t"+usn[i].getId()+
					"\t"+usn[i].getUsername()+
					"\t"+usn[i].getFirstname()+
					"\t"+usn[i].getLastname()+
					"\t"+usn[i].getEmail()
				);
			
			System.out.println ("Get course #2 events ");
			EventRecord[] evts=port.get_events(lr.getClient(),
						lr.getSessionkey(),
						2, //new BigInteger("2"), //event type course
						2 //new BigInteger("2")  //ownerid
						).getEvents();
			for (int i=0; i< evts.length;i++) 
				System.out.println (
					evts[i].getError()+"\t"+evts[i].getId()+
					"\t"+evts[i].getName()+
					"\t"+evts[i].getDescription()+
					"\t"+evts[i].getTimestart()+
					"\t"+evts[i].getTimeduration()
				);
				
			System.out.println ("logout and bye ...");
			System.out.println (port.logout(lr.getClient(),lr.getSessionkey()));
	
		} 
		catch (AxisFault af) {
			System.out.println ("axis fault "+af);
		}
	
		catch (Exception e) {
			System.out.println ("exception "+e);
		}
	
	}

}

