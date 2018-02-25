import java.util.ArrayList;
import java.util.Calendar;
import java.util.Date;

public class ReminderServer extends Thread {
	private EmailServer emailServer;
	private ReminderDAO dao;
	
	public ReminderServer() {
		emailServer = new EmailServer();
		dao = new ReminderDAO();
	}
	
	public void run() {
		while(true) {
			ArrayList<TaskRecord> records = dao.getAllTaskRecords();
			
			Date currentDate = new Date();
			Calendar calendar = Calendar.getInstance();
			calendar.setTime(currentDate);
			int day1 = calendar.get(Calendar.DAY_OF_MONTH);
			int month1 = calendar.get(Calendar.MONTH);
			int year1 = calendar.get(Calendar.YEAR);
			
			
			for(TaskRecord record : records) {
				Date otherDate = record.getDate();
				calendar.setTime(otherDate);
				int day2 = calendar.get(Calendar.DAY_OF_MONTH);
				int month2 = calendar.get(Calendar.MONTH);
				int year2 = calendar.get(Calendar.YEAR);
				
				
				if (day1 == day2 && month1 == month2 && year1 == year2) {
					int taskId = record.getTaskID();
					
					Task task = dao.getTask(taskId);
					User user = dao.getUser(task.getUserId());
					this.sendReminder(user, task);
					dao.updateTask(taskId);
				}
			}
			
			
		}
	}
	
	
	
	public void sendReminder(User user, Task task) {
		ReminderEmail reminderEmail = new ReminderEmail(user, task);
		
		emailServer.send(reminderEmail);
		
	}
	
	public static void main(String[] args) {
		ReminderServer rs = new ReminderServer();
		rs.start();
	}
	
}