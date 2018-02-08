import java.util.Arrays;
import java.util.Iterator;

public class User {

	private String id;
	private String username;
	private String firstName;
	private String lastName;
	private String emailAddress;
	private String[] tasks;
	private int taskNumber;

	// User constructor
	public User(String id, String username, String firstName, String lastName, String emailAddress) {
		this.id = id;
		this.username = username;
		this.firstName = firstName;
		this.lastName = lastName;
		this.emailAddress = emailAddress;
		taskNumber = 0;
	}

	// return an iterator of the user tasks
	public Iterator<String> getTasks() {
		return Arrays.asList(tasks).iterator();
	}

	// adding a tasks to user list
	public void addTasks(String task) {
		if (tasks == null) {
			tasks = new String[1];
			tasks[taskNumber] = task;
			taskNumber++;
		} else if (taskNumber == tasks.length) {
			// need code

		}

	}

	public String getEmailAddress() {
		return emailAddress;
	}

	public void setEmailAddress(String emailAddress) {
		this.emailAddress = emailAddress;
	}

	public String getLastName() {
		return lastName;
	}

	public void setLastName(String lastName) {
		this.lastName = lastName;
	}

	public String getFirstName() {
		return firstName;
	}

	public void setFirstName(String firstName) {
		this.firstName = firstName;
	}

	public String getUsername() {
		return username;
	}

	public void setUsername(String username) {
		this.username = username;
	}

	public String getId() {
		return id;
	}

	public void setId(String id) {
		this.id = id;
	}

}