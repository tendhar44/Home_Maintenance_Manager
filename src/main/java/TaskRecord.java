import java.util.Date;

/**
 * The purpose of this class is to hold necessary task information retrieved from database.
 * This information is used to check whether a task is due, and if so, to query the database
 * for necessary information. 
 * @author josephmunson
 *
 */

public class TaskRecord {
	
	private int taskID;
	private Date dueDate;
	private Date reminderDate;
	private int reminderInterval;
	
	public TaskRecord(int taskID, Date dueDate, Date reminderDate, int reminderInterval) {
		this.taskID = taskID;
		this.dueDate = dueDate;
		this.reminderDate = reminderDate;
		this.reminderInterval = reminderInterval;
	}
	
	public int getTaskID() {
		return taskID;
	}

	public void setTaskID(int taskID) {
		this.taskID = taskID;
	}

	public Date getDueDate() {
		return dueDate;
	}

	public void setDueDate(Date dueDate) {
		this.dueDate = dueDate;
	}

	public Date getReminderDate() {
		return reminderDate;
	}

	public void setReminderDate(Date reminderDate) {
		this.reminderDate = reminderDate;
	}

	public int getReminderInterval() {
		return reminderInterval;
	}

	public void setReminderInterval(int reminderInterval) {
		this.reminderInterval = reminderInterval;
	}

	

	
	
}
