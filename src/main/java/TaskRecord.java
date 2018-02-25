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
	private Date date;
	private boolean isSent;
	
	public TaskRecord(int taskID, Date date) {
		this.taskID = taskID;
		this.date = date;
	}
	
	public TaskRecord(int taskID, Date date, boolean isSent) {
		this.taskID = taskID;
		this.date = date;
		this.isSent = isSent;
	}
	
	public int getTaskID() {
		return taskID;
	}

	public void setTaskID(int taskID) {
		this.taskID = taskID;
	}

	public Date getDate() {
		return date;
	}

	public void setDate(Date date) {
		this.date = date;
	}

	public boolean isSent() {
		return isSent;
	}

	public void setSent(boolean isSent) {
		this.isSent = isSent;
	}

	@Override
	public String toString() {
		return "TaskRecord [taskID=" + taskID + ", date=" + date + "]";
	}

	

	
	
}
