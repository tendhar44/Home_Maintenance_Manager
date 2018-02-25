import java.util.Date;

public class Task {

	private int taskId;
	private int applianceId;
	private int userId;
	private String name;
	private String description;
	private Date dueDate;
	
	public Task(int taskId, int userId, String name, String description, Date dueDate) {
		this.taskId = taskId;
		this.userId = userId;
		this.name = name;
		this.description = description;
		this.dueDate = dueDate;
		
	}

	public int getTaskId() {
		return taskId;
	}

	public void setTaskId(int taskId) {
		this.taskId = taskId;
	}

	public int getApplianceId() {
		return applianceId;
	}

	public void setApplianceId(int applianceId) {
		this.applianceId = applianceId;
	}

	public int getUserId() {
		return userId;
	}

	public void setUserId(int userId) {
		this.userId = userId;
	}

	public String getName() {
		return name;
	}

	public void setName(String name) {
		this.name = name;
	}

	public String getDescription() {
		return description;
	}

	public void setDescription(String description) {
		this.description = description;
	}

	@Override
	public String toString() {
		return "Task [taskId=" + taskId + ", applianceId=" + applianceId + ", userId=" + userId + ", name=" + name
				+ ", description=" + description + ", dueDate=" + dueDate + "]";
	}

	public Date getDueDate() {
		return dueDate;
	}

	public void setDueDate(Date dueDate) {
		this.dueDate = dueDate;
	}
	
	

}
